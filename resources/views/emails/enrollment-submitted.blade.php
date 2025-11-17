<x-mail::message>
# New Enrollment Request

A new student has enrolled in **{{ $enrollment->course->title }}**.

## Student Information
- **Name:** {{ $enrollment->full_name }}
- **Email:** {{ $enrollment->email }}
- **Phone:** {{ $enrollment->phone }}
- **Enrollment Date:** {{ $enrollment->enrollment_date->format('F j, Y') }}

## Course Details
- **Course:** {{ $enrollment->course->title }}
- **Level:** {{ ucfirst($enrollment->course->level) }}
- **Duration:** {{ $enrollment->course->duration_weeks }} weeks
- **Price:** ¥{{ number_format($enrollment->course->price, 0) }}

@if($enrollment->message)
## Additional Message
{{ $enrollment->message }}
@endif

<x-mail::button :url="config('app.url') . '/admin'">
View in Admin Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
