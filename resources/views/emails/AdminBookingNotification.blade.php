@component('mail::message')
<div align="center">
        <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
    </div>
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
