@component('mail::message')
# Request received

Hello  {{ $user->name }},

Your request for the slide "{{ $request->slide->arabic_name }}" has been accepted. Please come to pick up the slide.

Thank you for using our service!

Best regards,<br>

Dr: Alsafa
@endcomponent
