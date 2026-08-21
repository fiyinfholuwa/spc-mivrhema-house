<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RoomMemberController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $data = $request->validate([
            'q' => ['required', 'string', 'max:255'],
        ]);
        $term = trim($data['q']);

        $rooms = Room::query()
            ->where(function ($query) use ($term) {
                $query->where('name', 'like', "%{$term}%")
                    ->orWhere('key_label', 'like', "%{$term}%");

                if (ctype_digit($term)) {
                    $query->orWhere('name', 'Room '.$term);
                }
            })
            ->withCount('activeMembers')
            ->orderBy('is_overflow')
            ->orderBy('id')
            ->limit(20)
            ->get()
            ->map(fn (Room $room) => [
                'type' => 'room',
                'room_name' => $room->name,
                'label' => $room->key_label,
                'active_count' => $room->active_members_count,
                'members_url' => route('room-members.index', $room),
                'add_member_url' => route('room-members.store', $room),
            ]);

        $members = RoomMember::query()
            ->with('room')
            ->where('name', 'like', "%{$term}%")
            ->latest('checked_in_at')
            ->limit(30)
            ->get()
            ->map(fn (RoomMember $member) => [
                'type' => 'member',
                'name' => $member->name,
                'phone' => $member->phone,
                'room_name' => $member->room->name,
                'exited' => $member->exited_at !== null,
                'members_url' => route('room-members.index', $member->room),
                'add_member_url' => route('room-members.store', $member->room),
            ]);

        return response()->json(['results' => $rooms->concat($members)->values()]);
    }

    public function index(Room $room): JsonResponse
    {
        $members = $room->members()
            ->with(['recordedBy', 'exitedBy'])
            ->orderByRaw('exited_at IS NOT NULL')
            ->latest('checked_in_at')
            ->get();

        return response()->json([
            'room' => ['id' => $room->id, 'name' => $room->name],
            'active_count' => $members->whereNull('exited_at')->count(),
            'members' => $members->map(fn (RoomMember $member) => [
                'id' => $member->id,
                'name' => $member->name,
                'phone' => $member->phone,
                'checked_in_at' => $member->checked_in_at->format('M j, Y · g:i A'),
                'exited_at' => $member->exited_at?->format('M j, Y · g:i A'),
                'recorded_by' => $member->recordedBy?->name ?? 'Deleted user',
                'exited_by' => $member->exited_at ? ($member->exitedBy?->name ?? 'Deleted user') : null,
                'exit_url' => route('room-members.exit', $member),
            ]),
        ]);
    }

    public function store(Request $request, Room $room): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+()\-\s]+$/'],
        ]);

        $room->members()->create([
            ...$data,
            'checked_in_at' => now(),
            'recorded_by' => $request->user()->id,
        ]);

        $message = "{$data['name']} added to {$room->name}.";

        return $request->expectsJson()
            ? response()->json(['message' => $message, 'room_id' => $room->id], 201)
            : back()->with('status', $message);
    }

    public function markExited(Request $request, RoomMember $member): RedirectResponse|JsonResponse
    {
        DB::transaction(function () use ($member, $request) {
            $lockedMember = RoomMember::query()->lockForUpdate()->findOrFail($member->id);
            if ($lockedMember->exited_at) {
                throw ValidationException::withMessages(['member' => 'This room member has already exited.']);
            }

            $lockedMember->update([
                'exited_at' => now(),
                'exited_by' => $request->user()->id,
            ]);
        });

        $message = "{$member->name} marked as exited from {$member->room->name}.";

        return $request->expectsJson()
            ? response()->json(['message' => $message, 'room_id' => $member->room_id])
            : back()->with('status', $message);
    }
}
