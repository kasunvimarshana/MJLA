<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormSubmitted;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store a new contact form submission
     */
    public function store(ContactFormRequest $request)
    {
        // Rate limiting - allow 3 submissions per hour per IP
        $key = 'contact-form:'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->withErrors([
                'rate_limit' => __('messages.forms.rate_limit', ['seconds' => $seconds]),
            ])->withInput();
        }

        // Increment rate limiter
        RateLimiter::hit($key, 3600); // 1 hour

        // Create contact record
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new',
        ]);

        // Send email notification (in production, queue this)
        try {
            Mail::to(config('mail.from.address'))
                ->send(new ContactFormSubmitted($contact));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            logger()->error('Failed to send contact form email: '.$e->getMessage());
        }

        return redirect()->route('contact.index')
            ->with('success', __('messages.forms.success'));
    }
}
