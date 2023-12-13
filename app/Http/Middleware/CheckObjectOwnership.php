<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CustomerObiect;

class CheckObjectOwnership
{
    /**
     * Middleware sprawdza własność danego obiektu. Jeżeli obiekt należy do usera, to puszcza dalej, jeśli nie wyrzuca błąd.
     */
    public function handle(Request $request, Closure $next)
    {
        $objectId = $request->route('obiect_id');

        // Sprawdź, czy obiekt o podanym id należy do zalogowanego użytkownika
        $object = CustomerObiect::find($objectId);

        if (!$object || $object->customer_id !== auth()->user()->customer_id) {
            return response()->json(['error' => 'Unauthorized'], 403); // Kwestia dostosowania widoku i odpowiedzi
        }

        return $next($request);
    }
}
