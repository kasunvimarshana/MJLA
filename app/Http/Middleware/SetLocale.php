<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session, or fallback to browser preference
        $locale = session('locale');
        
        if (!$locale) {
            // Try to get from Accept-Language header
            $locale = $request->getPreferredLanguage(['en', 'si', 'ja']) ?? config('app.locale');
        }
        
        // Validate locale
        if (!in_array($locale, ['en', 'si', 'ja'])) {
            $locale = config('app.locale');
        }
        
        // Set application locale
        app()->setLocale($locale);
        
        return $next($request);
    }
}
