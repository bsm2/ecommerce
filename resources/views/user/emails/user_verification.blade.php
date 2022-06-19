@component('mail::message')
# Hello from ecommerce-app

Click here to Verify your account


@component('mail::button', ['url' => url('api/user/verify/'.$data['verification_token']) ])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
