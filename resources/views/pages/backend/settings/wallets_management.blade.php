@extends('layouts.backend')

@section('page-title') Wallets Managements @endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Update Wallets</h4>
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
                        <form method="post" action="{{url('settings/wallets/update-wallet')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Wallet</label>
                                        <select class="form-control" required name="user_id">
                                            <option value="">[SELECT USER]</option>
                                            @foreach($wallets as $serial => $wallet)
                                                <option value="{{$wallet->user_id}}">
                                                    {{\App\Profile::where('user_id',$wallet->user_id)->first()->sur_name}}
                                                    {{\App\Profile::where('user_id',$wallet->user_id)->first()->first_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Transaction Type</label>
                                        <select class="form-control" required name="status">
                                            <option value="">[SELECT TYPE]</option>
                                            <option value="1" class="success">Credit +</option>
                                            <option value="0" class="danger">Debit + </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>(&#x20a6;) Amount</label>
                                        <input type="number" class="form-control" required name="amount" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button class="btn btn-primary btn-block"><i class="la la-cloud-upload"></i> Update Wallet</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Wallets Management</h4>
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
                        <ul class="nav nav-tabs nav-top-border no-hover-bg">
                            <li class="nav-item">
                                <a class="nav-link active" id="baseIcon-tab11" data-toggle="tab" aria-controls="tabIcon11" href="#tabIcon11" aria-expanded="true"><i class="la la-google-wallet"></i> Wallets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="baseIcon-tab12" data-toggle="tab" aria-controls="tabIcon12" href="#tabIcon12" aria-expanded="false"><i class="la la-list"></i> Wallet Logs</a>
                            </li>
                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane active" id="tabIcon11" aria-expanded="true" aria-labelledby="baseIcon-tab11">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered file-export">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>User</th>
                                        <th>Balance</th>
                                    </tr>
                                    </thead>
                                        <tbody>
                                        @foreach($wallets as $serial => $wallet)
                                        <tr>
                                            <td>{{$serial}}</td>
                                            <td>
                                                {{\App\Profile::where('user_id',$wallet->user_id)->first()->sur_name}}
                                                {{\App\Profile::where('user_id',$wallet->user_id)->first()->first_name}}
                                            </td>
                                            <td>
                                                &#x20a6; {{number_format(($wallet->balance / 100),2)}}
                                            </td>
                                        </tr>
                                         @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabIcon12" aria-labelledby="baseIcon-tab12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered file-export">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($walletLogs as $serial => $walletLog)
                                        <tr>
                                            <td>{{$serial}}</td>
                                            <td>
                                                {{\App\Profile::where('user_id',$walletLog->user_id)->first()->sur_name}}
                                                {{\App\Profile::where('user_id',$walletLog->user_id)->first()->first_name}}
                                            </td>
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
        </div>
    </div>

@endsection



@section('javascript')

@endsection

@section('css')

@endsection