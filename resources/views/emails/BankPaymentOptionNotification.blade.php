@component('mail::message')
<div align="center">
   <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center" />
</div>
# Hi {{\App\Profile::getUserInfo(auth()->user()->id)->first_name}},

You selected the pay by bank option for your booking, your booking will be placed on hold pending payment of the sum of <b>&#x20a6;{{number_format(($booking['total_amount'] / 100),2)}}</b>. Find below your booking reference

@component('mail::panel')
<div align="center">
 <b>{{ $booking['reference']}}</b>
</div>
@endcomponent

Kindly follow the link below to manage your dashboard to manage your booking ...

@component('mail::button', ['url' => '/dashboard'])

<i class="la la-dashboard"></i> Dashboard

@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
