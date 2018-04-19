@component('mail::message')
<div class="fixed-top">
    <div class="image-wrapper">
        <img src="{{asset('assets/images/logo.png')}}" style="height: 100px;" alt="" />
    </div>
</div>

# Hi there

Thanks for signing up on our portal. From now on, you can easily search and book affordable flights, hotels and holiday packages on our platform. We will also start providing you discounts on any of the bookings you make with us. You can view your bookings and manage all booking you have made with us through the button below.

@component('mail::button', ['url' => route('dashboard')])
    Bookings
@endcomponent
Cheers ,<br>
{{ config('app.name') }}
@endcomponent
