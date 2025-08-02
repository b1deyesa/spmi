<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FakultasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $fakultas = $request->route('fakultas');
        
        if (!$fakultas || !$request->user()->fakultases()->where('fakultas.id', $fakultas->id)->exists()) {
            return redirect()->back();
        }

        return $next($request);
    }
}
