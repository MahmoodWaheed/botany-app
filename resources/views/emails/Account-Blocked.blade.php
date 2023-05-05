@component('mail::message')
# Account Blocked

Dear {{ $user->name }},

We regret to inform you that your account has been temporarily blocked because you have failed to return the slide '{{ $slide->arabic_name }}' with id {{ $slide->id }} within the deadline.

To unblock your account, please return the slide as soon as possible. Once the slide is returned, please contact us to reactivate your account.

We understand that circumstances may arise that prevent you from returning the slide on time. If you need more time or have any questions or concerns, please contact us immediately.

Thank you for your attention and cooperation.

Best regards,<br>

Dr: Alsafa
@endcomponent

