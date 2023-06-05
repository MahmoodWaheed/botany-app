@component('mail::message')
{{-- Custom Icon --}}
<img src="{{ asset('icons/botany-icon.png') }}" alt="Botany Icon" width="50" height="50">
# Request received

Dear {{ $user->name }},

This is a friendly reminder that the deadline for your request is approaching.

The deadline is on {{ $Deadline }} . 

Please return the requested item with id {{ $slide->id }} before the deadline to avoid being blocked from further requests.

If you have any questions or concerns, please contact us.

Thank you for your attention and cooperation.

Best regards,<br>

Dr: Alsafa
@endcomponent

