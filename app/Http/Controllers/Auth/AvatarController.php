<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function upload(Request $request)
    {
        $user = Auth::user();

        if ($user === $request->user()) {

            // dd($request->all());

            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'avatar_original' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            // Zpracování a ukládání avataru
            $this->processAvatar($request);
        }
    }

    public function delete(Request $request)
    {
        $user = Auth::user();

        if ($user === $request->user()) {
            $request->user()->clearMediaCollection('avatar');
            $request->user()->clearMediaCollection('avatar_original');
            $request->user()->avatar = null;
            $request->user()->avatar_original = null;
            $request->user()->save();
        }
    }

    private function processAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {

            $request->user()->clearMediaCollection('avatar');

            $request->user()->addMediaFromRequest('avatar')
                ->usingFileName($request->user()->username . '_avatar.' . $request->file('avatar')->getClientOriginalExtension())
                ->toMediaCollection('avatar');

            $request->user()->avatar = $request->user()->getFirstMediaUrl('avatar', 'compressed');
            $request->user()->avatar_full = $request->user()->getFirstMediaUrl('avatar');
        }

        if ($request->hasFile('avatar_original')) {

            $request->user()->clearMediaCollection('avatar_original');

            $request->user()->addMediaFromRequest('avatar_original')
                ->usingFileName($request->user()->username . '_avatar_original.' . $request->file('avatar_original')->getClientOriginalExtension())
                ->toMediaCollection('avatar_original');

            $request->user()->avatar_original = $request->user()->getFirstMediaUrl('avatar_original');
        }

        $request->user()->save();
    }
}
