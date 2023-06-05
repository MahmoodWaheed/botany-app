@component('mail::message')
{{-- Custom Icon --}}
<img src="{{ asset('icons/botany-icon.png') }}" alt="Botany Icon" width="50" height="50">
# Request received

Dear {{ $user->name }},

We have received your request for the {{ $slide->arabicName }} slide. We will process your request as soon as possible.

Thank you for using our service!

Best regards,<br>

Dr: Alsafa
@endcomponent
