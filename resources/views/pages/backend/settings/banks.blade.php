@extends('layouts.backend')

@section('page-title') Bank Details  @endsection

@section('activeSettings') open hover  @endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-4" id="enter_bank_details_card_body">
            <div class="card">
                <div class="card-header">
                    <h3 id="save_header">Add Bank Account Details</h3>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" value="" class="form-control" id="account_name"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="number" value="" class="form-control" id="account_number"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank</label>
                                <select class="form-control" id="bank_id">
                                    <option value="">[SELECT BANK]</option>
                                    @foreach(\App\Bank::getAllBanks() as $i => $bank)
                                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Branch</label>
                                <input type="text" value="" class="form-control" id="bank_branch"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Ifsc Code</label>
                                <input type="text" value="" class="form-control" id="bank_ifsc_code"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Pan Code</label>
                                <input type="text" value="" class="form-control" id="bank_pan_code"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="editOrSave" id="editOrSave" value="1"/>
                    <input type="hidden" name="id" id="bank_details_id" value=""/>
                    <button class="btn btn-alt-primary upload-bank pull-right" id="bank_upload_button">Save</button>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Bank Details</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Bank Name</th>
                            <th>Bank Branch</th>
                            <th>IFSC Code</th>
                            <th>Pan Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="table-body">
                        @foreach(\App\BankDetail::getAllBankDetails() as $j => $bankDetail)
                            <tr id="row_{{$bankDetail->id}}">
                                <td>{{$bankDetail->account_name}}</td>
                                <td>{{$bankDetail->account_number}}</td>
                                <td>{{\App\Bank::getBankById($bankDetail->bank_id)->name}}</td>
                                <td>{{$bankDetail->bank_branch}}</td>
                                <td>{{$bankDetail->ifsc_code}}</td>
                                <td>{{$bankDetail->pan}}</td>
                                <td id="status_{{$bankDetail->id}}">
                                    @if($bankDetail->status == 1)
                                        <span class="badge badge-success"><i class="la la-check"></i>&nbsp;ACTIVE</span>
                                    @else
                                        <span class="badge badge-danger"><i class="la la-times"></i>&nbsp;DISABLED</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success activate" data-toggle="tooltip" title="Activate bank info"  value="{{$bankDetail->id}}"><i class="la la-check"></i></button>
                                    <button type="button" class="btn btn-sm btn-warning deactivate" data-toggle="tooltip" title="De-activate bank info" value="{{$bankDetail->id}}"><i class="la la-times"></i></button>
                                    <button type="button" class="btn btn-sm btn-primary edit"     data-toggle="tooltip" title="Edit bank info"  value="{{$bankDetail->id}}"><i class="la la-edit"></i></button>
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
    <script src="{{asset('backend/js/pages/bank_details.js')}}"></script>

@endsection