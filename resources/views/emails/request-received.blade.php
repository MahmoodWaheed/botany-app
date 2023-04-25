@component('mail::message')
# Request received

Dear {{ $user->name }},

We have received your request for the {{ $slide->arabicName }} slide. We will process your request as soon as possible.

Thank you for using our service!

Best regards,<br>

Dr: Alsafa
@endcomponent
