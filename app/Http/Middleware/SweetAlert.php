<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SweetAlert
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
        if (session()->has('success')) {
            $notification = session()->get('success');
            session()->forget('success');
            return response()->json([
                'message' => $notification,
                'type' => 'success'
            ]);
        }
        if (session()->has('error')) {
            $notification = session()->get('error');
            session()->forget('error');
            return response()->json([
                'message' => $notification,
                'type' => 'error'
            ]);
        }

        return $next($request);
    }
}