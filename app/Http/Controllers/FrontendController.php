<?php

namespace App\Http\Controllers;

use App\Models\ConferenceRegistration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;

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
            'marital_status' => 'nullable|string|max:255',
            'coming_with_spouse' => 'nullable|string|max:255',
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



    public function store_api(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'location' => 'nullable|string|max:255',
            'how_heard' => 'required|string|max:255',
            'previous_participation' => 'required|string|max:255',
            'registration_type' => 'required|string|max:255',
            'group_name' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'coming_with_spouse' => 'nullable|string|max:255',
            'group_size' => 'nullable|integer|min:1',
            'expectations' => 'required|string|max:1000',
            'commitment' => 'required|string|max:1000',
            'source_type' => 'required',
            'receive_updates' => 'required|in:yes,no', // assuming yes/no
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        ConferenceRegistration::create($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Registration successful.',
        ], 201);
    }


    public function confirmArrival($id)
    {
        $registration = \App\Models\ConferenceRegistration::findOrFail($id);

        // Only assign a group if not already confirmed
        if ($registration->confirmed_reg !== 'confirmed') {
            // Get the last confirmed registration with a bible group
            $lastGroup = \App\Models\ConferenceRegistration::where('confirmed_reg', 'confirmed')
                ->whereNotNull('bible_group')
                ->orderByDesc('id')
                ->value('bible_group');

            // Determine next group (1 to 7, then wrap around)
            $nextGroup = ($lastGroup ?? 0) % 7 + 1;

            // Update and save
            $registration->confirmed_reg = 'confirmed';
            $registration->bible_group = $nextGroup;
            $registration->save();
        }

        return response()->json(['success' => true]);
    }

}
