@component('mail::message')
# Introduction

Click here to Reset your password

@component('mail::button', ['url' => url('admin/reset/password/'.$data['token']) ])
Reset
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
