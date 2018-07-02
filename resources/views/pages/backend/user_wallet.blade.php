@extends('layouts.backend')

@section('page-title') Wallets Managements @endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h6 class="text-muted">Wallet Balance </h6>
                                <h2>&#x20a6;{{number_format(($userWallet->balance/100),2)}}</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-wallet success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card pull-up">
                <div class="card-header">
                    <h4 class="card-title text-center">{{--Wallet Credits and Debits--}}</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h6 class="danger text-bold-600">Debits</h6>
                                <h4 class="text-bold-100">&#x20a6;{{number_format(($walletDebits/100),2)}}</h4>
                            </div>
                            <div class="col-md-6 col-12 text-center">
                                <h6 class="success text-bold-600">Credits</h6>
                                <h4 class="text-bold-100">&#x20a6;{{number_format(($walletCredits/100),2)}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top Up Wallet</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                       <div class="row">
                           <div class="col-md-12">
                                 <img src="{{asset('frontend/assets/images/portal_images/interswitch.png')}}" class="img-responsive col-md-12"/>
                           </div>
                           <div class="col-md-12">
                               <form method="post" action="{{$InterswitchConfig->requestActionUrl}}">
                                   <div class="col-md-12">
                                       <input type="hidden" class="reference" name="txn_ref" value=""/>
                                       <input type="hidden" name="currency" value="566"/>
                                       <input type="hidden" class="item_id" name="pay_item_id" value="{{$InterswitchConfig->item_id}}"/>
                                       <input type="hidden" class="redirect_url" name="site_redirect_url" value=""/>
                                       <input type="hidden" class="product_id" name="product_id" value="{{$InterswitchConfig->product_id}}"/>
                                       <input type="hidden" class="cust_id" name="cust_id" value="{{$user->user_id}}"/>
                                       <input type="hidden" name="cust_name" value="{{$user->sur_name}} {{$user->first_name}}"/>
                                       <input type="hidden" class="hash" name="hash" value=""/>
                                       <input type="hidden" class="actual_amount form-control" name="amount" value=""/>
                                       <div class="form-group">
                                           <label>(&#x20a6;) Top Up Amount</label>
                                           <input type="number" class="amount form-control" value=""/>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <button type="button" class="btn btn-primary btn-sm generate_wallet_payment"><i class="la la-lock"></i> GENERATE PAYMENT </button>
                                           <button type="submit" class="btn btn-primary btn-sm interswitch_pay_now hidden"><i class="la la-money"></i> PAY NOW</button>
                                       </div>
                                   </div>
                               </form>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> My Wallet Log</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered file-export">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userWalletLogs as $serial => $walletLog)
                                    <tr>
                                        <td>{{$serial}}</td>
                                        <td>&#x20a6; {{number_format(($walletLog->amount/100),2)}}</td>
                                        <td>
                                            @if($walletLog->status == 1)
                                                <p class="success"> Credit</p>
                                            @elseif($walletLog->status == 0)
                                                <p class="danger"> Debit</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{\App\WalletLogType::find($walletLog->type_id)->name}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection



@section('javascript')
    <script src="{{asset('backend/js/pages/user_wallet.js')}}"></script>
@endsection

@section('css')

@endsection