<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomKeyLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RoomKeyController extends Controller
{
    public function index(): View
    {
        $rooms = Room::with('activeKeyLog')->orderBy('is_overflow')->orderBy('id')->get();

        return view('room-keys.index', compact('rooms'));
    }

    public function checkout(Request $request, Room $room): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'collector_name' => ['required', 'string', 'max:255'],
            'collector_phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+()\-\s]+$/'],
            'checkout_note' => ['nullable', 'string', 'max:1000'],
            'activity_type' => ['nullable', 'in:collected,completed'],
            'collected_at' => ['nullable', 'required_if:activity_type,completed', 'date', 'before_or_equal:now'],
            'returned_at' => ['nullable', 'required_if:activity_type,completed', 'date', 'after_or_equal:collected_at', 'before_or_equal:now'],
            'return_note' => ['nullable', 'string', 'max:1000'],
            'same_returner' => ['nullable', 'boolean'],
            'returner_name' => [Rule::excludeIf($request->boolean('same_returner')), 'nullable', Rule::requiredIf($request->input('activity_type') === 'completed'), 'string', 'max:255'],
            'returner_phone' => [Rule::excludeIf($request->boolean('same_returner')), 'nullable', Rule::requiredIf($request->input('activity_type') === 'completed'), 'string', 'max:30', 'regex:/^[0-9+()\-\s]+$/'],
        ]);

        DB::transaction(function () use ($room, $data, $request) {
            $lockedRoom = Room::query()->lockForUpdate()->findOrFail($room->id);
            if ($lockedRoom->keyLogs()->whereNull('returned_at')->exists()) {
                throw ValidationException::withMessages(['room' => 'This key is already checked out.']);
            }
            $completed = ($data['activity_type'] ?? 'collected') === 'completed';
            $lockedRoom->keyLogs()->create([
                'collector_name' => $data['collector_name'],
                'collector_phone' => $data['collector_phone'],
                'checkout_note' => $data['checkout_note'] ?? null,
                'collected_at' => $data['collected_at'] ?? now(),
                'checked_out_by' => $request->user()->id,
                'returned_at' => $completed ? $data['returned_at'] : null,
                'returner_name' => $completed ? (($data['same_returner'] ?? false) ? $data['collector_name'] : $data['returner_name']) : null,
                'returner_phone' => $completed ? (($data['same_returner'] ?? false) ? $data['collector_phone'] : $data['returner_phone']) : null,
                'returned_by' => $completed ? $request->user()->id : null,
                'return_note' => $completed ? ($data['return_note'] ?? null) : null,
            ]);
        });

        $message = ($data['activity_type'] ?? null) === 'completed'
            ? "{$room->name} manual collection and return logged successfully."
            : "{$room->name} key collected successfully.";

        return $request->expectsJson()
            ? response()->json(['message' => $message, 'room_id' => $room->id])
            : back()->with('status', $message);
    }

    public function returnKey(Request $request, RoomKeyLog $keyLog): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'return_note' => ['nullable', 'string', 'max:1000'],
            'same_returner' => ['nullable', 'boolean'],
            'returner_name' => [Rule::requiredIf(! $request->boolean('same_returner')), 'nullable', 'string', 'max:255'],
            'returner_phone' => [Rule::requiredIf(! $request->boolean('same_returner')), 'nullable', 'string', 'max:30', 'regex:/^[0-9+()\-\s]+$/'],
        ]);
        DB::transaction(function () use ($keyLog, $data, $request) {
            $log = RoomKeyLog::query()->lockForUpdate()->findOrFail($keyLog->id);
            if ($log->returned_at) {
                throw ValidationException::withMessages(['room' => 'This key has already been returned.']);
            }
            $log->update([
                'returned_at' => now(),
                'returner_name' => ($data['same_returner'] ?? false) ? $log->collector_name : $data['returner_name'],
                'returner_phone' => ($data['same_returner'] ?? false) ? $log->collector_phone : $data['returner_phone'],
                'returned_by' => $request->user()->id,
                'return_note' => $data['return_note'] ?? null,
            ]);
        });

        $message = "{$keyLog->room->name} key returned successfully.";

        return $request->expectsJson()
            ? response()->json(['message' => $message, 'room_id' => $keyLog->room_id])
            : back()->with('status', $message);
    }

    public function history(Request $request, Room $room): View|JsonResponse
    {
        $logs = $room->keyLogs()->with(['checkedOutBy', 'returnedBy'])->latest('collected_at')->paginate(25);

        if ($request->expectsJson()) {
            return response()->json([
                'room' => ['name' => $room->name, 'key_label' => $room->key_label],
                'logs' => $logs->through(fn (RoomKeyLog $log) => [
                    'collector_name' => $log->collector_name,
                    'collector_phone' => $log->collector_phone,
                    'collected_at' => $log->collected_at->format('M j, Y · g:i A'),
                    'checked_out_by' => $log->checkedOutBy?->name ?? 'Deleted user',
                    'returned_at' => $log->returned_at?->format('M j, Y · g:i A'),
                    'returner_name' => $log->returner_name,
                    'returner_phone' => $log->returner_phone,
                    'returned_by' => $log->returned_at ? ($log->returnedBy?->name ?? 'Deleted user') : null,
                    'checkout_note' => $log->checkout_note,
                    'return_note' => $log->return_note,
                ]),
            ]);
        }

        return view('room-keys.history', compact('room', 'logs'));
    }
}
