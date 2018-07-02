@component('mail::message')
<div align="center">
   <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hi there

Thanks for signing up on our portal. From now on, you can easily search and book affordable flights, hotels and holiday packages on our platform. We will also start providing you discounts on any of the bookings you make with us. You can view your bookings and manage all booking you have made with us through the button below.

@component('mail::button', ['url' => route('dashboard')])
    Bookings
@endcomponent
Sincerely ,<br>
{{ config('app.name') }}
@endcomponent
