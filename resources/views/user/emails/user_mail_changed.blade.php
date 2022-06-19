@component('mail::message')
# Hello from ecommerce-app

Click here to confirm your new email


@component('mail::button', ['url' => url('api/user/verify/'.$data['verification_token']) ])
Confirm
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
