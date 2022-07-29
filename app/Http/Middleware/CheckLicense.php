<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckLicense
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
        $connected = @fsockopen("www.google.com", 80);
        if ($connected) {
            $response = Http::get('https://raw.githubusercontent.com/kennethsolomon/license/main/sample.json');
            $is_expired = json_decode($response)->wrs_solomon;
            if ($is_expired == 'expired') {
                abort(404);
            } elseif ($is_expired == 'trial' || $is_expired == 'licensed') {
                return $next($request);
            }
        } else {
            abort(404);
        }
    }
}
