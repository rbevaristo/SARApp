@component('mail::message')
# Change password Request

Click on the button below to change password.

@component('mail::button', ['url' => ''])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
