<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // on récupère le token présent dans le header de la requête
        $apiToken = $request->headers->get('api-token');

        // On cherche dans la base un utilisateur avec cet api_token
        $user = User::where('api_token', $apiToken)->get()->first();

        // On vérifie qu'il y a bien un utilisateur
        if (!$user instanceof User) {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
    }
}
