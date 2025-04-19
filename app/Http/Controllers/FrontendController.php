<?php

namespace App\Http\Controllers;

use App\Models\ConferenceRegistration;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home(){
        return view('welcome');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'location' => 'nullable|string',
            'how_heard' => 'required|string',
            'previous_participation' => 'required|string',
            'registration_type' => 'required|string',
            'group_name' => 'nullable|string',
            'group_size' => 'nullable|integer',
            'expectations' => 'required|string',
            'commitment' => 'required|string',
            'receive_updates' => 'required|string',
        ]);

        ConferenceRegistration::create($validated);

        return response()->json(['status' => 'success', 'message' => 'Registration successful.']);
    }

    public function showRegistrationsPage()
    {
        $registrations = ConferenceRegistration::orderByDesc('id')->get();
        return view('get_data', compact('registrations'));
    }

}
