@extends('layouts.backend')

@section('page-title')Packages Categories @endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Package Categories                     <a class="btn btn-success btn-addon pull-right btn-sm" data-toggle="modal" data-target="#add_package_category"><i class="fa fa-plus"></i> Add New</a>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper">
              @include('flash::message')
              @if($errors->any())
                <ul class="alert alert-danger" style="list-style: none;">
                  @foreach($errors->all() as $error)
                    <li style="color: #000 !important;"> {{ $error }} </li>
                  @endforeach
                </ul>
              @endif
              <table id="flight_table" class="display table" style="width: 100%;" role="grid" aria-describedby="example_info">
                <thead>
                <tr>
                  <th rowspan="1" colspan="1">#</th>
                  <th rowspan="1" colspan="1">Package Category</th>
                  <th rowspan="1" colspan="1">Status</th>
                  <th rowspan="1" colspan="1">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($package_categories as $serial => $package_category)
                  <tr>
                    <td>{{$serial+1}}</td>
                    <td>{{$package_category->category}}</td>
                    <td id="status_{{$package_category->id}}">
                      @if($package_category->status == 1)
                        <span class="badge badge-success"><i class="fa fa-check"></i> Active</span>
                        @elseif($package_category->status == 0)
                        <span class="badge badge-danger"><i class="fa fa-check"></i> Disabled</span>
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_{{$package_category->id}}"><i class="la la-edit"></i></button>
                      <button class="btn btn-primary btn-sm activate" data-toggle="tooltip" title="Activate package category" value="{{$package_category->id}}"><i class="la la-check"></i></button>
                      <button class="btn btn-danger btn-sm deActivate" data-toggle="tooltip" title="Deactivate package category"  value="{{$package_category->id}}"><i class="la la-times"></i></button>

                    </td>
                  </tr>
                  <div class="modal fade" id="edit_{{$package_category->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="mySmallModalLabel">Edit package category</h4>
                        </div>
                        <form method="post" action="{{url('backend/travel-packages/categoryCreateOrUpdate')}}">
                          {{csrf_field()}}
                          <input type="hidden" name="category_id" value="{{$package_category->id}}" />
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label> Package Category</label>
                                  <input type="text" value="{{$package_category->category}}" name="category" class="form-control" required/>
                                </div>
                              </div>
                            </div>


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success"> Save</button>

                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="add_package_category" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="mySmallModalLabel">Add package category</h4>
        </div>
        <form method="post" action="{{url('backend/travel-packages/categoryCreateOrUpdate')}}">
          {{csrf_field()}}
          <input type="hidden" name="category_id" value="" />
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label> Package Category</label>
                  <input type="text" value="" name="category" class="form-control" required/>
                </div>
              </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success"> Save</button>

        </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
<script src="{{asset('backend/js/pages/package-categories.js')}}"></script>
@endsection