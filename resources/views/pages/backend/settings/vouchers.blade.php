@extends('layouts.backend')

@section('page-title') Voucher Management  @endsection

@section('activeSettings') open hover  @endsection

@section('content')

    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b id="voucher_card_title">Create Vouchers</b></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="hidden" name="voucher_id" value="" id="voucher_id"/>
                            <div class="form-group">
                                <label>Voucher Amount</label>
                                <input type="number" name="amount" id="voucher_amount" value="" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;&nbsp;</label>
                                <button class="btn btn-primary btn-block" id="create_voucher"> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Voucher Code</th>
                            <th>Amount </th>
                            <th>Status</th>
                            <th>Settings</th>
                        </tr>
                        </thead>
                        <tbody id="vouchers_table_body_new">
                        @foreach(\App\Voucher::orderBy('id','desc')->get() as $serial => $voucher)
                            <tr id="row_{{$voucher->id}}">
                                <td><b>{{$voucher->code}}</b></td>
                                <td>{{number_format(($voucher->amount/100), 2)}}</td>
                                <td id="status_{{$voucher->id}}">
                                    @if($voucher->status == 0)
                                        <span class="badge badge-warning">Disabled</span>
                                    @elseif($voucher->status == 1)
                                        <span class="badge badge-primary">Active</span>
                                    @elseif($voucher->status == 2)
                                        <span class="badge badge-success">Used</span>
                                    @elseif($voucher->status == 3)
                                        <span class="badge badge-info">Given Out</span>
                                    @endif
                                </td>
                                <td id="action_{{$voucher->id}}">
                                    @if($voucher->status == 0)
                                        <button class="btn btn-info btn-sm activate" value="{{$voucher->id}}">     Activate </button>
                                        <button class="btn btn-danger btn-sm delete" value="{{$voucher->id}}">     Delete   </button>
                                    @endif
                                    @if($voucher->status == 1)
                                        <button class="btn btn-warning btn-sm disable" value="{{$voucher->id}}">   Disable  </button>
                                        <button class="btn btn-primary btn-sm give_out" value="{{$voucher->id}}">  Give Out </button>
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

    <script src="{{asset('backend/js/pages/vouchers.js')}}"></script>

@endsection