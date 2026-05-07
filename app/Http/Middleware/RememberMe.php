<?php

namespace App\Http\Middleware;

use App\Models\RememberToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RememberMe
{
    /**
     * Auto-login user via remember-me cookie if session has expired.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only run if user is currently a guest
        if (!Auth::guard('web')->check()) {
            $cookieToken = $request->cookie('remember_me');

            if ($cookieToken && is_string($cookieToken)) {
                $record = RememberToken::where('token', $cookieToken)
                    ->where('expires_at', '>', now())
                    ->first();

                if ($record) {
                    $user = User::find($record->user_id);
                    if ($user) {
                        Auth::guard('web')->login($user);
                        $request->session()->regenerate();
                        // Refresh last activity timestamp for session expiry tracking
                        session(['last_activity' => now()->timestamp]);
                    }
                } else {
                    // Token invalid or expired — clean up cookie
                    cookie()->queue(cookie()->forget('remember_me'));
                }
            }
        }

        return $next($request);
    }
}
