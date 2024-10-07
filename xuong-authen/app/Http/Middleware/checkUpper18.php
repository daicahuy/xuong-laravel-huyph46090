<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkUpper18
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->getAge() < 18) {
            return back()->with('message', [
                'type' => 'danger',
                'message' => 'Ban chua du 18 tuoi de truy cap duong link nay'
            ]);
        }

        return $next($request);
    }
}
