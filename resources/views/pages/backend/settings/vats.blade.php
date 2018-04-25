@extends('layouts.backend')

@section('page-title') Vats Management  @endsection

@section('activeSettings') open hover  @endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-header" id="vat_header">
                    Add VAT
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <i class="fa fa-info-circle"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>Note!</strong> all fields are required
                    </div>

                    {!! Form::open(['route'=> 'backend-save-vat']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::select('vat_type',$vat_types ,null, ['id'=>'vat_type', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose vat type']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::select('vat_value_type',$vat_value_types ,null, ['id'=>'vat_value_type', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose vat value type']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::number('vat_value',null, ['id'=>'vat_value', 'class'=>'form-control', 'placeholder'=>'vat value e.g. 12.00']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button id="save_vat" class="btn btn-alt-primary btn-sm pull-right" type="button">Save</button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header">Vat List</div>
                <div class="card-body table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Value Type</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="vat-body">
                        <tr>
                            <td>Flight</td>
                            <td>{{\App\MarkupValueType::find($vat->flight_vat_type)->type}}</td>
                            <td>{{$vat->flight_vat_value}}</td>
                            <td><button class="btn btn-primary btn-sm editVat" value="flight" data-toggle="tooltip" title="Edit flight vat information"><i class="la la-edit"></i></button></td>
                        </tr>
                        <tr>
                            <td>Hotel</td>
                            <td>{{\App\MarkupValueType::find($vat->hotel_vat_type)->type}}</td>
                            <td>{{$vat->hotel_vat_value}}</td>
                            <td><button class="btn btn-primary btn-sm editVat" value="hotel" data-toggle="tooltip" title="Edit hotel vat information"><i class="la la-edit"></i></button></td>
                        </tr>
                        <tr>
                            <td>Car</td>
                            <td>{{\App\MarkupValueType::find($vat->car_vat_type)->type}}</td>
                            <td>{{$vat->car_vat_value}}</td>
                            <td><button class="btn btn-primary btn-sm editVat" value="car" data-toggle="tooltip" title="Edit car vat information"><i class="la la-edit"></i></button></td>
                        </tr>
                        <tr>
                            <td>Package</td>
                            <td>{{\App\MarkupValueType::find($vat->package_vat_type)->type}}</td>
                            <td>{{$vat->package_vat_value}}</td>
                            <td><button class="btn btn-primary btn-sm editVat" value="package" data-toggle="tooltip" title="Edit car vat information"><i class="la la-edit"></i></button></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script src="{{asset('backend/js/pages/vat.js')}}"></script>

@endsection