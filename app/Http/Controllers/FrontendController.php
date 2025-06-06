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

        if ($registration->confirmed_reg !== 'confirmed') {

            // Count how many members are in each group (1–7)
            $groupCounts = \App\Models\ConferenceRegistration::where('confirmed_reg', 'confirmed')
                ->selectRaw('bible_group, COUNT(*) as total')
                ->groupBy('bible_group')
                ->pluck('total', 'bible_group');

            // Build array of counts for groups 1 to 7
            $groupUsage = [];
            for ($i = 1; $i <= 7; $i++) {
                $groupUsage[$i] = $groupCounts[$i] ?? 0;
            }

            // Find the group with the least number of members
            $nextGroup = array_keys($groupUsage, min($groupUsage))[0];

            // Assign
            $registration->confirmed_reg = 'confirmed';
            $registration->bible_group = $nextGroup;
            $registration->save();
        }

        return response()->json([
            'success' => true,
            'assigned_group' => $registration->bible_group
        ]);
    }

}
