<x-mail::message>
# New Consultation Request

A new consultation request has been submitted.

## Applicant Information
- **Name:** {{ $consultationRequest->full_name }}
- **Email:** {{ $consultationRequest->email }}
- **Phone:** {{ $consultationRequest->phone }}
- **Preferred Date:** {{ $consultationRequest->preferred_date?->format('F j, Y') ?? 'Not specified' }}
- **Preferred Time:** {{ $consultationRequest->preferred_time ?? 'Not specified' }}

@if($consultationRequest->visaService)
## Service Requested
**{{ $consultationRequest->visaService->title }}**
@endif

@if($consultationRequest->message)
## Additional Message
{{ $consultationRequest->message }}
@endif

<x-mail::button :url="config('app.url') . '/admin'">
View in Admin Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
