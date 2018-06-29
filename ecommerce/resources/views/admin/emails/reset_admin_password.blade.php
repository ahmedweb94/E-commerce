@component('mail::message')
# Introduction

Welcome {{ $data['data']->name }}<br>
Reset Admin Password

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
Reset Password
@endcomponent
Or copy this link <a href="{{ aurl('reset/password/'.$data['token']) }}">{{ aurl('reset/password/'.$data['token']) }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
