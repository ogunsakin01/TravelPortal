@component('mail::message')
<div align="center">
        <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
    </div>
# Hello {{$user->sur_name}} ,

Your account password has just been changed. Please if your account password was not changed by you, kindly send a complain to {{config('app.name')}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
