@extends('layouts.backend')

@section('page-title') Airline Markdown  @endsection

@section('activeSettings') open hover  @endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-12 col-12">
            <div class="card">
                <div class="card-header" id="markdown_header">
                    Add Markdown
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Airline</label>
                                <input class="form-control airline-type-ahead" id="airline" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Value</label>
                                <input class="form-control" id="value" type="number" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" id="value_type">
                                    <option value="">[SELECT]</option>
                                    <option value="1"> Percentage </option>
                                    <option value="2"> Naira </option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <button id="add_markdown" class="btn btn-alt-primary pull-right">Add Markdown</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    Airlines Markdown
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Airline Code</th>
                            <th>Airline Name</th>
                            <th>Type</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($markdowns as $i => $markdown)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$markdown->airline_code}}</td>
                                <td>{{\App\Airline::getAirline($markdown->airline_code)}}</td>
                                <td>{{\App\MarkupValueType::find($markdown->type)->type}}</td>
                                <td>{{$markdown->value}}</td>
                                <td><button class="btn btn-sm btn-primary edit" value="{{$markdown->id}}" data-toggle="tooltip" title="Edit markdown information"><i class="la la-edit"></i></button></td>
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
    <script src="{{asset('backend/js/pages/markdown.js')}}"></script>

@endsection