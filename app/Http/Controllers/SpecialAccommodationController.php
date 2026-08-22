<?php

namespace App\Http\Controllers;

use App\Models\ConferenceRegistration;
use App\Models\SpecialAccommodation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SpecialAccommodationController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search'));
        $entries = SpecialAccommodation::query()
            ->with(['registration:id,fullname,phone', 'createdBy:id,name'])
            ->when($search, fn ($query) => $query->where(fn ($query) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('possible_departure_at', 'like', "%{$search}%")
                ->orWhere('notes', 'like', "%{$search}%")))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('special-accommodations.index', compact('entries', 'search'));
    }

    public function registrationSearch(Request $request): JsonResponse
    {
        $data = $request->validate(['q' => ['required', 'string', 'min:2', 'max:255']]);
        $term = trim($data['q']);

        $registrations = ConferenceRegistration::query()
            ->where('confirmed_reg', 'confirmed')
            ->whereNotIn('id', SpecialAccommodation::query()
                ->select('conference_registration_id')
                ->whereNotNull('conference_registration_id'))
            ->where(fn ($query) => $query
                ->where('fullname', 'like', "%{$term}%")
                ->orWhere('phone', 'like', "%{$term}%"))
            ->orderBy('fullname')
            ->limit(12)
            ->get(['id', 'fullname', 'phone']);

        return response()->json(['results' => $registrations]);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $data = $this->validated($request);
        $data['created_by'] = $request->user()->id;
        SpecialAccommodation::create($data);

        $message = "{$data['name']} added to special accommodation.";

        return $request->expectsJson()
            ? response()->json(['message' => $message], 201)
            : back()->with('status', $message);
    }

    public function update(Request $request, SpecialAccommodation $specialAccommodation): RedirectResponse|JsonResponse
    {
        $specialAccommodation->update($this->validated($request, $specialAccommodation));

        $message = "{$specialAccommodation->name}'s details were updated.";

        return $request->expectsJson()
            ? response()->json(['message' => $message])
            : back()->with('status', $message);
    }

    public function destroy(Request $request, SpecialAccommodation $specialAccommodation): RedirectResponse|JsonResponse
    {
        $name = $specialAccommodation->name;
        $specialAccommodation->delete();

        $message = "{$name} removed from special accommodation.";

        return $request->expectsJson()
            ? response()->json(['message' => $message])
            : back()->with('status', $message);
    }

    private function validated(Request $request, ?SpecialAccommodation $entry = null): array
    {
        return $request->validate([
            'conference_registration_id' => [
                'nullable',
                'integer',
                Rule::exists('conference_registrations', 'id')->where('confirmed_reg', 'confirmed'),
                Rule::unique('special_accommodations')->ignore($entry),
            ],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+()\-\s]+$/'],
            'possible_departure_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
