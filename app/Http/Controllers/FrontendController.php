<?php

namespace App\Http\Controllers;

use App\Models\ConferenceFeedback;
use App\Models\ConferenceRegistration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



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
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'how_heard' => 'required|string|max:255',
            'previous_participation' => 'required|string|max:255',
            'mode_of_participation' => 'required|string|max:255',
            'accommodation_preference' => 'nullable|string|max:255',
            'registration_type' => 'required|string|max:255',
            'group_name' => 'nullable|string|max:255',
            'marital_status' => 'required|string|max:255',
            'coming_with_spouse' => 'nullable|string|max:255',
            'group_size' => 'nullable|integer|min:1',
            'expectations' => 'nullable|string',
            'commitment' => 'required|string|max:255',
            'receive_updates' => 'required|string|max:255',
        ]);

        $validated['expectations'] = $validated['expectations'] ?? '';
        $registration = ConferenceRegistration::where('email', $validated['email'])->first();

        if ($registration) {
            $registration->update($validated);

            return response()->json([
                'status' => 'exists',
                'message' => 'This email is already registered. We have updated your details.',
            ]);
        }

        ConferenceRegistration::create($validated);

        return response()->json(['status' => 'success', 'message' => 'Registration successful.']);
    }

    public function showRegistrationsPage(Request $request)
    {
        $query = ConferenceRegistration::query();

        if ($search = trim((string) $request->query('search'))) {
            $query->where(function ($builder) use ($search) {
                $builder->where('fullname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('group_name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->query('status')) {
            $status === 'pending'
                ? $query->where(function ($builder) {
                    $builder->whereNull('confirmed_reg')->orWhere('confirmed_reg', 'pending');
                })
                : $query->where('confirmed_reg', $status);
        }

        if ($type = $request->query('type')) {
            $query->where('registration_type', $type);
        }

        $registrations = $query->orderByDesc('id')->paginate(12)->withQueryString();
        $stats = [
            'total' => ConferenceRegistration::count(),
            'confirmed' => ConferenceRegistration::where('confirmed_reg', 'confirmed')->count(),
            'pending' => ConferenceRegistration::whereNull('confirmed_reg')->orWhere('confirmed_reg', 'pending')->count(),
            'assigned' => ConferenceRegistration::whereNotNull('bible_group')->where('bible_group', '!=', '')->count(),
            'individual' => ConferenceRegistration::where('registration_type', 'individual')->count(),
            'group' => ConferenceRegistration::where('registration_type', 'group')->count(),
        ];

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json(['registrations' => $registrations, 'stats' => $stats]);
        }

        return view('get_data', compact('registrations', 'stats'));
    }
    public function showRegistrationsPageFeedback(Request $request)
    {
        $query = ConferenceFeedback::query();

        if ($search = trim((string) $request->query('search'))) {
            $query->where(function ($builder) use ($search) {
                $builder->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('rating_overall', 'like', "%{$search}%")
                    ->orWhere('spiritual_impact', 'like', "%{$search}%")
                    ->orWhere('content_quality', 'like', "%{$search}%")
                    ->orWhere('speaker_rating', 'like', "%{$search}%")
                    ->orWhere('testimonies', 'like', "%{$search}%");
            });
        }

        if ($rating = $request->query('rating')) {
            $query->where('rating_overall', $rating);
        }

        $registrations = $query->orderByDesc('id')->paginate(12)->withQueryString();
        $stats = [
            'total' => ConferenceFeedback::count(),
            'excellent' => ConferenceFeedback::where('rating_overall', 'like', '%excellent%')->count(),
            'high_impact' => ConferenceFeedback::where(function ($builder) {
                $builder->where('spiritual_impact', 'like', '%high%')
                    ->orWhere('spiritual_impact', 'like', '%very%');
            })->count(),
            'attend_again' => ConferenceFeedback::where('attend_again', 'like', 'yes%')->count(),
            'inspiring' => ConferenceFeedback::where('speaker_rating', 'like', '%inspiring%')->count(),
            'exceptional' => ConferenceFeedback::where('content_quality', 'like', '%exceptional%')->count(),
        ];

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json(['feedback' => $registrations, 'stats' => $stats]);
        }

        return view('get_feeback', compact('registrations', 'stats'));
    }

    public function analytics()
    {
        $registrations = ConferenceRegistration::select([
            'mode_of_participation',
            'gender',
            'how_heard',
            'marital_status',
        ])->get();

        $groupCounts = function (string $field) use ($registrations) {
            return $registrations
                ->map(function ($registration) use ($field) {
                    $value = trim((string) $registration->{$field});

                    return $value === '' ? 'Not specified' : ucfirst(strtolower($value));
                })
                ->countBy()
                ->sortDesc()
                ->all();
        };

        $virtualCount = $registrations->filter(function ($registration) {
            return strtolower(trim((string) $registration->mode_of_participation)) === 'virtual';
        })->count();

        $analytics = [
            'participation' => [
                'Virtual' => $virtualCount,
                'Physical' => $registrations->count() - $virtualCount,
            ],
            'gender' => $groupCounts('gender'),
            'how_heard' => $groupCounts('how_heard'),
            'marital_status' => $groupCounts('marital_status'),
        ];

        return view('analytics', [
            'analytics' => $analytics,
            'total' => $registrations->count(),
        ]);
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
            'assigned_group' => $registration->bible_group,
            'registration' => $registration->fresh(),
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


    public function sendPendingEmails()
    {
        // Fetch only 10 pending emails at a time
        $emails = DB::table('send_email_tbl')
            ->where('status', 'pending')
            ->orderBy('id')
            ->limit(1)
            ->get();
    
        foreach ($emails as $email) {
            try {
                Mail::send([], [], function ($message) use ($email) {
                    $message->to($email->email, $email->full_name)
                            ->subject($email->subject)
                            ->html("Dear {$email->full_name},<br><br>" . base64_decode($email->body));
                        });
    
                DB::table('send_email_tbl')
                    ->where('id', $email->id)
                    ->update(['status' => 'sent', 'updated_at' => now()]);
    
            } catch (\Exception $e) {
                DB::table('send_email_tbl')
                    ->where('id', $email->id)
                    ->update([
                        'status' => 'failed',
                        'updated_at' => now(),
                        'error_message' => $e->getMessage() // optional: store the error
                    ]);
            }
        }
    
        return response()->json([
            'message' => 'Processed up to 10 emails',
            'processed' => count($emails)
        ]);
    }
    


public function prepareEmails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string',
            'subject' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $body = $request->body;

        // Fetch users from conference_registrations
        $users = DB::table('conference_registrations')->select('fullname', 'email')->get();

        foreach ($users as $user) {
            DB::table('send_email_tbl')->updateOrInsert(
                ['email' => $user->email], // unique key
                [
                    'full_name' => $user->fullname,
                    'email' => $user->email,
                    'body' => $body,
                    'subject' => $request->subject,
                    'status' => 'pending',
                    'updated_at' => now(),
                ]
            );
        }

        return response()->json(['message' => 'Emails prepared successfully']);
    }
}
