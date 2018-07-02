@component('mail::message')
<div align="center">
    <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hi {{$user->first_name}},

A credit transaction has just happened on your wallet with us. Find below the transaction information

Type             :   <i class="fa fa-plus"></i>Credit<br/>
Amount           :   <b>&#x20a6;{{number_format(($walletLog->amount /100),2)}} </b><br/>
Remark           :   {{\App\WalletLogType::find($walletLog->type_id)->name}}


Follow the button below to your wallet management page

@component('mail::button', ['url' => url('/settings/wallets/user-wallet')])
My Wallet
@endcomponent

Sincerely ,<br>
{{ config('app.name') }}
@endcomponent
