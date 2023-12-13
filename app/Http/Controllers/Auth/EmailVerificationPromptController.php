<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        /* return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('auth.verify-email'); */

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('dashboard');
                case 'client':
                    return redirect()->route('clientpanel');
                // Dodaj inne przypadki według potrzeb
                default:
                    return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        return view('auth.verify-email');
    }
}
