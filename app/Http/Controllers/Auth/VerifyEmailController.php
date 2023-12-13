<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        // Sprawdzenie, czy użytkownik jest zalogowany
        if (auth()->check()) {
            // Sprawdzenie, czy e-mail jest już zweryfikowany
            if ($request->user()->hasVerifiedEmail()) {
                return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
            }

            // Oznaczenie e-maila jako zweryfikowanego i wyemitowanie zdarzenia Verified
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }

            // Sprawdzenie roli użytkownika i przekierowanie na odpowiednią trasę
            if (auth()->user()->role == 'admin') {
                return redirect()->route('newDashboard', ['verified' => 1]);
            }

            if (auth()->user()->role == 'client') {
                return redirect()->route('clientpanel', ['verified' => 1]);
            }
        }

        // W przypadku, gdy użytkownik nie jest zalogowany, możesz przekierować go na inną trasę
        return redirect()->route('login');
    }
}
