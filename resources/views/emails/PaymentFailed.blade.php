@component('mail::message')
<div align="center">
        <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# <b style="color: red;">Payment Failed</b>

Your attempt to make a payment of <b>&#x20a6;{{number_format(($response['amount']/100),2)}} </b> on our platform failed. Your booking will be placed on hold pending payment.

You can always attempt paying for the booking again, visit your dashboard to manage your bookings and payments

@component('mail::button', ['url' => '/dashboard'])
   Dashboard
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
