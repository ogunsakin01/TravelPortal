@extends('layouts.backend')

@section('page-title') Markups Management  @endsection

@section('activeSettings') open hover  @endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header" id="header_info">
                    Add Markup
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <i class="la la-info-circle"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>Note!</strong> all fields are required
                    </div>

                    {!! Form::open(['route'=> 'backend-save-markup']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::select('role',$roles ,null, ['id'=>'role', 'class'=>'form-control form-control-sm', 'placeholder'=>'select role']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::select('markup_type',$markup_types ,null, ['id'=>'markup_type', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose markup type']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::select('markup_value_type',$markup_value_types ,null, ['id'=>'markup_value_type', 'class'=>'form-control form-control-sm', 'placeholder'=>'choose markup value type']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::number('markup_value',null, ['id'=>'markup_value', 'class'=>'form-control', 'placeholder'=>'markup value e.g. 12.00']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button id="save_markup" class="btn btn-alt-primary btn-sm pull-right" type="button">Save</button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">Markup List</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Type</th>
                            <th>Value Type</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="markup-body">
                        @foreach(\App\Markup::all() as $i => $markup)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{\App\Role::find($markup->role_id)->display_name}}</td>
                                <td>Flight</td>
                                <td>{{\App\MarkupValueType::find($markup->flight_markup_type)->type}}</td>
                                <td>{{$markup->flight_markup_value}}</td>
                                <td><button class="btn btn-primary btn-sm edit_markup" value="{{$markup->id}}_flight" data-toggle="tooltip" title="Edit markup information"><i class="la la-edit"></i></button></td>
                            </tr>
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{\App\Role::find($markup->role_id)->display_name}}</td>
                                <td>Hotel</td>
                                <td>{{\App\MarkupValueType::find($markup->hotel_markup_type)->type}}</td>
                                <td>{{$markup->hotel_markup_value}}</td>
                                <td><button class="btn btn-primary btn-sm edit_markup" value="{{$markup->id}}_hotel" data-toggle="tooltip" title="Edit markup information"><i class="la la-edit"></i></button></td>
                            </tr>
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{\App\Role::find($markup->role_id)->display_name}}</td>
                                <td>Car</td>
                                <td>{{\App\MarkupValueType::find($markup->car_markup_type)->type}}</td>
                                <td>{{$markup->car_markup_value}}</td>
                                <td><button class="btn btn-primary btn-sm edit_markup" value="{{$markup->id}}_car" data-toggle="tooltip" title="Edit markup information"><i class="la la-edit"></i></button></td>
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
    <script src="{{asset('backend/js/pages/markups.js')}}"></script>

@endsection