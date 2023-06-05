@component('mail::message')
{{-- Custom Icon --}}
<img src="{{ asset('icons/botany-icon.png') }}" alt="Botany Icon" width="50" height="50">
# Request received

Dear {{ $user->name }},

We regret to inform you that your request for the slide "{{ $slide->arabicName }}" has been rejected.

Please contact us for further information regarding your request.

Thank you,

Best regards,<br>

Dr: Alsafa
@endcomponent
