<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Switch application locale
     */
    public function switch(Request $request, string $locale)
    {
        // Validate locale
        if (!in_array($locale, ['en', 'si', 'ja'])) {
            abort(400, 'Invalid locale');
        }
        
        // Store locale in session
        session(['locale' => $locale]);
        
        // Redirect back to previous page
        return redirect()->back();
    }
}
