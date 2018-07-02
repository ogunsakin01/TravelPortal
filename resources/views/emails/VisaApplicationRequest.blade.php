@component('mail::message')
<div align="center">
    <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hello,

A new visa application request, find details below

Surname             :   <b> {{$details->surname}} </b> <br/>
Given name          :   <b> {{$details->given_name}} </b> <br/>
Phone number        :   <b> {{$details->phone}} </b> <br/>
Email               :   <b> {{$details->email}} </b> <br/>
Residence   Country :   <b> {{$details->residency_country}} </b> <br/>
Destination Country :   <b> {{$details->destination_country}} </b> <br/>
IpAddress           :   <b> {{$details->ip()}} </b>

@component('mail::button', ['url' => url('/settings/visa-application-requests')])
    Application Requests
@endcomponent

{{ config('app.name') }}
@endcomponent
