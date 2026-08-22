<?php

namespace App\Http\Controllers;

use App\Models\ConferenceRegistration;
use App\Models\SpecialAccommodation;
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
                ->orWhere('notes', 'like', "%{$search}%")))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $confirmedRegistrations = ConferenceRegistration::query()
            ->where('confirmed_reg', 'confirmed')
            ->whereNotIn('id', SpecialAccommodation::query()->select('conference_registration_id')->whereNotNull('conference_registration_id'))
            ->orderBy('fullname')
            ->get(['id', 'fullname', 'phone']);

        return view('special-accommodations.index', compact('entries', 'confirmedRegistrations', 'search'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['created_by'] = $request->user()->id;
        SpecialAccommodation::create($data);

        return back()->with('status', "{$data['name']} added to special accommodation.");
    }

    public function update(Request $request, SpecialAccommodation $specialAccommodation): RedirectResponse
    {
        $specialAccommodation->update($this->validated($request, $specialAccommodation));

        return back()->with('status', "{$specialAccommodation->name}'s details were updated.");
    }

    public function destroy(SpecialAccommodation $specialAccommodation): RedirectResponse
    {
        $name = $specialAccommodation->name;
        $specialAccommodation->delete();

        return back()->with('status', "{$name} removed from special accommodation.");
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
