@component('mail::message')
# New Contact Form Submission

You have received a new contact form submission from the MJLA website.

**From:** {{ $contact->name }}  
**Email:** {{ $contact->email }}  
**Phone:** {{ $contact->phone ?? 'Not provided' }}  
**Subject:** {{ $contact->subject }}

**Message:**

{{ $contact->message }}

---

**Submission Details:**
- Date: {{ $contact->created_at->format('F d, Y H:i:s') }}
- IP: {{ request()->ip() ?? 'Unknown' }}

@component('mail::button', ['url' => config('app.url') . '/admin/contacts/' . $contact->id])
View in Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
