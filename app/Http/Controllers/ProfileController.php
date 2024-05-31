<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\FeedService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    protected $feedService;

    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    public function show(User $user, Request $request)
    {
        $feed = [];
        $offset = $request->header('offset', 0);

        $parameters = [
            'user_id' => $user->id,
        ];

        $isOwnProfile = Auth::user()->id === $user->id;

        try {
            $feed = $this->feedService->getFeed($parameters, 5, $offset);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return Inertia::render('Profile/Profile', [
            'feed' => Inertia::lazy(fn () => $feed),
            'offset' => Inertia::lazy(fn () => $offset + count($feed)),
            'user' => $user->only('id', 'first_name', 'last_name', 'username', 'bio', 'email', 'avatar'),
            'isOwnProfile' => $isOwnProfile,
            'errors' => session()->get('error'),
            'flash' => [
                'error' => fn () => session()->pull('error'),
            ]
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Settings/YourAccount/ProfileInfo', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('settings.profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
