<?php

namespace App\Http\Controllers;

use App\Models\ConferenceFeedback;
use App\Models\ConferenceRegistration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function home(){
        return view('welcome');
    }
    public function feedback(){
        return view('feedback');
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
    public function showRegistrationsPageFeedback()
    {
        $registrations = ConferenceFeedback::orderByDesc('id')->get();
        return view('get_feeback', compact('registrations'));
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


    public function submit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'rating_overall' => 'required|string',
            'spiritual_impact' => 'required|string',
            'highlight_sessions' => 'nullable|string',
            'content_quality' => 'required|string',
            'speaker_rating' => 'required|string',
            'logistics' => 'nullable|string',
            'venue_rating' => 'nullable|string',
            'attend_again' => 'required|string',
            'improvements' => 'nullable|string',
            'testimonies' => 'nullable|string',
        ]);

        // Check if a feedback already exists for this name or email
        $exists = ConferenceFeedback::where('full_name', $validated['full_name'])
            ->when($validated['email'], function ($query) use ($validated) {
                return $query->orWhere('email', $validated['email']);
            })
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'You have already submitted feedback. Thank you!',
            ], 409); // 409 Conflict
        }

        ConferenceFeedback::create($validated);

        return response()->json(['message' => 'Thank you for your detailed feedback!']);
    }


}
