<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerObiect;
use App\Http\Controllers\CustomerObiectsController;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(Auth::user()->role == 'admin')
        {
            return redirect()->route('dashboard');
        }

        if(Auth::user()->role == 'admin' || 'manager')
        {
            // metody które pozwalają ustawić id jakiegokolwiek obiektu albo przypisać 0 aby wyświetlić moduł do stworzenia biznesu
            $getId = CustomerObiect::where('customer_id', Auth::user()->customer_id)->first();
            if($getId){
                $id = $getId->id;
            }else{
                $id = 0;
            }

            return redirect()->route('dashboard', $id);
        }

        if(Auth::user()->role == 'client')
        {
            return redirect()->route('clientpanel');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
