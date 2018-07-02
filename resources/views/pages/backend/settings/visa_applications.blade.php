@extends('layouts.backend')

@section('page-title') Visa Applications @endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Visa Applications</h4>
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
                            <table class="table table-bordered file-export">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Surname</th>
                                    <th>Given name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Residence Country</th>
                                    <th>Destination Country</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($visaApplications as $serial => $visaApplication)
                                    <tr>
                                        <td>{{$serial}}</td>
                                        <td>{{$visaApplication->surname}}</td>
                                        <td>{{$visaApplication->given_name}}</td>
                                        <td>{{$visaApplication->email}}</td>
                                        <td>{{$visaApplication->phone}}</td>
                                        <td>{{$visaApplication->residence_country}}</td>
                                        <td>{{$visaApplication->destination_country}}</td>
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

@endsection

