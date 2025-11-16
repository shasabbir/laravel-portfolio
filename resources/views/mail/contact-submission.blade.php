@component('mail::message')
# New Contact Form Message

**Name:** {{ $submission->name }}  
**Email:** {{ $submission->email }}

**Message**

{!! nl2br(e($submission->message)) !!}

@endcomponent
