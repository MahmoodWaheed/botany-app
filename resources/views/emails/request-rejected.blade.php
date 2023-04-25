@component('mail::message')
# Request received

Dear {{ $user->name }},

We regret to inform you that your request for the slide "{{ $request->slide->arabic_name }}" has been rejected.

Please contact us for further information regarding your request.

Thank you,

Best regards,<br>

Dr: Alsafa
@endcomponent
