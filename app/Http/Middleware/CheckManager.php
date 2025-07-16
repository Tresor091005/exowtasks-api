<?php

namespace App\Http\Middleware;

use App\Enums\MembreRole;
use Closure;
use Illuminate\Http\Request;

class CheckManager
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user->role !== MembreRole::MANAGER->value) {
            return response()->json([
                'message' => 'Accès refusé. Le rôle de manager est requis.'
            ], 403);
        }

        return $next($request);
    }
}
