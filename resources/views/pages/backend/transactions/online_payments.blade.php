@extends('layouts.backend')

@section('page-title')  Online Payments  @endsection






@section('content')

   <div class="row">
       <div class="col-xl-3 col-lg-6 col-12">
           <div class="card pull-up">
               <div class="card-content">
                   <div class="card-body">
                       <div class="media d-flex">
                           <div class="media-body text-left">
                               <h3 class="success"> ({{$countSuccessful}}) 	&#x20A6;{{number_format(($amountSuccessful/100),2)}}</h3>
                               <h6>Successful</h6>
                           </div>
                           <div>
                               <i class="icon-check success font-large-2 float-right"></i>
                           </div>
                       </div>
                       <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-xl-3 col-lg-6 col-12">
           <div class="card pull-up">
               <div class="card-content">
                   <div class="card-body">
                       <div class="media d-flex">
                           <div class="media-body text-left">
                               <h3 class="danger">({{$countPending}}) 	&#x20A6;{{number_format(($amountPending/100), 2)}}</h3>
                               <h6>Pending/Failed</h6>
                           </div>
                           <div>
                               <i class="icon-close danger font-large-2 float-right"></i>
                           </div>
                       </div>
                       <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                           <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">History</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <table class="table table-striped table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Transaction Reference</th>
                            <th>Booking Reference</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Response Code</th>
                            <th>Response Description</th>
                            <th>Transaction Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($interswitchPayments as $serial => $interswitchPayment)
                        <tr>
                            <td>{{$serial + 1}}</td>
                            <td>{{$interswitchPayment->reference}}</td>
                            <td>{{$interswitchPayment->booking_reference}}</td>
                            <td>{{\App\Profile::where('user_id',$interswitchPayment->user_id)->first()->sur_name}}</td>
                            <td>&#x20a6;{{number_format(($interswitchPayment->amount/100),2)}}</td>
                            <th class="payment_status_{{$interswitchPayment->id}}">
                                @if($interswitchPayment->payment_status == 1)
                                    <p class="success"><i class="la la-check"></i> Successful</p>
                                    @else
                                    <p class="warning"><i class="la la-warning"></i> Pending</p>
                                @endif
                            </th>
                            <td class="response_code_{{$interswitchPayment->id}}">{{$interswitchPayment->response_code}}</td>
                            <td class="response_description_{{$interswitchPayment->id}}">{{$interswitchPayment->response_description}}</td>
                            <td>{{$interswitchPayment->created_at}}</td>
                            <td>
                                 <button class="btn btn-outline-primary requery" type="submit" value="{{$interswitchPayment->id}}"> Requery </button>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection





@section('javascript')
<script src="{{asset('backend/js/pages/online_payments.js')}}"></script>
@endsection

@section('css')

@endsection