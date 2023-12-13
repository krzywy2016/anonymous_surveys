<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;
use Illuminate\Http\Request;

class GlobalViever
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $users_role = DB::table('users')
            ->join('users_role', 'users.users_role_id', '=', 'users_role.id')
            ->where('users.id', Auth::user()->id)
            ->select('users_role.name')
            ->first();

        if($users_role->name == 'GlobalViever'){
            return $next($request);
        }

        abort(403);
    }
}
