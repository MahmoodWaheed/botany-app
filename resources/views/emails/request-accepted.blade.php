@component('mail::message')
{{-- Custom Icon --}}
<img src="{{ asset('icons/botany-icon.png') }}" alt="Botany Icon" width="50" height="50">
# Request received

Hello  {{ $user->name }},

Your request for the slide "{{ $slide->arabicName }}" has been accepted. Please come to pick up the slide within 3 days from now.

Thank you for using our service!

Best regards,<br>

Dr: Alsafa
@endcomponent
