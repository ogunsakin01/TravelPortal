@extends('layouts.backend')

@section('page-title')  Bank Payments  @endsection






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
                                <h3 class="warning">({{$countPending}}) 	&#x20A6;{{number_format(($amountPending/100), 2)}}</h3>
                                <h6>Pending</h6>
                            </div>
                            <div>
                                <i class="icon-warning warning font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <h3 class="danger">({{$countDeclined}}) 	&#x20A6;{{number_format(($amountDeclined/100), 2)}}</h3>
                                <h6>Declined</h6>
                            </div>
                            <div>
                                <i class="icon-warning danger font-large-2 float-right"></i>
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
            @if ($errors->any())
                @foreach($errors->all() as $i => $error)
                    <div class="alert round bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Oh snap!</strong> {{$error}}
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> History</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <table class="table table-striped table-responsive table-bordered file-export">
                        <thead>
                        <tr>
                            <th>Transaction Reference</th>
                            <th>Booking Reference</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Bank</th>
                            <th>Payment Status</th>
                            <th>Payment Proof</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bankPayments as $serial => $bankPayment)

                          <tr>
                              <div class="modal fade text-left payment_proof_{{$bankPayment->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                          <div class="card">
                                              <div class="card-header">
                                                  <h4 class="card-title">View and Edit Payment Proof</h4>
                                              </div>
                                              <div class="card-content">
                                                  <img class="img-fluid" src="{{asset($bankPayment->slip_photo)}}" alt="{{$bankPayment->reference}}">
                                                  <div class="card-body">
                                                      <p class="card-text">You can always come back and update your payment proof</p>
                                                      <div class="row">
                                                          <form method="post" enctype="multipart/form-data" action="{{url('/transactions/update-payment-proof')}}">
                                                              @csrf
                                                              <input type="hidden" name="user_id" value="{{$bankPayment->user_id}}"/>
                                                              <div class="col-md-8">
                                                                  <div class="form-group">
                                                                      <label>Payment Proof Link</label>
                                                                      <input type="file" name="payment_proof_file" value="" class="form-control" required/>
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                  <div class="form-group">
                                                                      <label>&nbsp;</label>
                                                                      <button class="btn btn-primary btn-block" type="submit"> Update Proof</button>
                                                                  </div>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <td>{{$bankPayment->reference}}</td>
                              <td>{{$bankPayment->booking_reference}}</td>
                              <td>
                                  {{\App\Profile::where('user_id',$bankPayment->user_id)->first()->sur_name}}
                                  {{\App\Profile::where('user_id',$bankPayment->user_id)->first()->first_name}}
                              </td>
                              <td>
                                  &#x20a6;{{number_format(($bankPayment->amount/100),2)}}
                              </td>
                              <td>
                                  {{\App\Bank::find(\App\BankDetail::find($bankPayment->bank_detail_id)->bank_id)->name}} , {{\App\BankDetail::find($bankPayment->bank_detail_id)->account_name}}, {{\App\BankDetail::find($bankPayment->bank_detail_id)->account_number}}
                              </td>
                              <td class="status_{{$bankPayment->id}}">
                                  @if($bankPayment->status == 0)
                                      <p class="danger"> Decline</p>
                                  @elseif($bankPayment->status == 1)
                                      <p class="success"> Approved</p>
                                  @elseif($bankPayment->status == 2)
                                      <p class="warning"> Pending</p>
                                  @endif
                              </td>
                              <td>
                                 <button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".payment_proof_{{$bankPayment->id}}"> View/Edit</button>
                              </td>
                              <td>
                                  @if($bankPayment->status == 0)
                                      <button class="btn btn-sm btn-success approve" value="{{$bankPayment->id}}" data-toggle="tool-tip" data-original-title="Approve payment"><i class="la la-sm la-check"></i></button>
                                  @elseif($bankPayment->status == 1)
                                      <button class="btn btn-sm btn-danger decline" value="{{$bankPayment->id}}" data-toggle="tool-tip" data-original-title="Decline payment"><i class="la la-sm la-times"></i></button>
                                  @elseif($bankPayment->status == 2)
                                      <button class="btn btn-sm btn-success approve" value="{{$bankPayment->id}}" data-toggle="tool-tip" data-original-title="Approve payment"><i class="la la-sm la-check"></i></button>
                                      <button class="btn btn-sm btn-danger decline" value="{{$bankPayment->id}}" data-toggle="tool-tip" data-original-title="Decline payment"><i class="la la-sm la-times"></i></button>
                                  @endif
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
    <script src="{{asset('backend/js/pages/bank_payments.js')}}"></script>
@endsection

@section('css')

@endsection