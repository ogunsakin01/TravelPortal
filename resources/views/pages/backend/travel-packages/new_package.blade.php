@extends('layouts.backend')

@section('page-title') New Travel Package @endsection

@section('content')

    <input type="hidden" value="" class="package_id"/>
    <input type="hidden" value="" class="attraction_id"/>
    <input type="hidden" value="" class="hotel_id"/>

    <input type="hidden" value="0" class="flight"/>
    <input type="hidden" value="0" class="hotel"/>
    <input type="hidden" value="0" class="attraction"/>

    <div class="row base_package">
        <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-info-circle"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Note!</strong> all fields are required
            </div>
            <div class="card">
                <div class="card-header">
                 New Travel Package
                </div>
                <div class="card-body">
                    <h4>Package Options <small>Select at least one</small> <hr/></h4>
                    <div class="row">
                     <div class="col-md-2">
                         <div class="form-group">
                             <lable>&nbsp;</lable>
                             <input type="checkbox" name="package_options[]" class="checkbox package_options" value="flight"> Flight
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group">
                             <lable>&nbsp;</lable>
                             <input type="checkbox" name="package_options[]" class="checkbox package_options" value="hotel"> Hotel
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group">
                             <lable>&nbsp;</lable>
                             <input type="checkbox" name="package_options[]" class="checkbox package_options" value="attraction"> Attraction
                         </div>
                     </div>
                 </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <lable>Package Name *</lable>
                                <input type="text" class="form-control package_name" name="package_name" value="" placeholder="e.g (Exclusive Dubai Vacation)" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <lable>Select Category *</lable>
                                <select class="form-control package_category" name="package_category">
                                      @foreach($package_categories as $package_category)
                                       <option value="{{$package_category->id}}">{{$package_category->category}}</option>
                                          @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <lable>Contact Number *</lable>
                                <input type="text" class="form-control package_contact_number" name="package_contact_number" value="" placeholder="e.g (+234 801 000 1234)" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Brief Package Information *</label>
                                <textarea class="form-control package_information" rows="5" name="package_information" placeholder="A brief or detailed explanation on the package. This information will be visible to the user.">

                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Package Pricing</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(&#x20A6;) Adult Price *</label>
                                <input type="number" value="" class="form-control adult_price" name="adult_price" placeholder="e.g 100000"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(&#x20A6;) Child Price *</label>
                                <input type="number" value="" class="form-control child_price" name="child_price" placeholder="e.g 100000"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(&#x20A6;) Infant Price *</label>
                                <input type="number" value="" class="form-control infant_price" name="infant_price" placeholder="e.g 100000"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <button type="button" class="btn btn-alt-primary create_new_package"> Continue(Save Package) </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row flight_deal hidden">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
               Flight Deals
              </div>
              <div class="card-body">
                  <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                           <label>Origin *</label>
                           <input type="text" class="form-control typeahead flight_deal_origin" name="flight_deal_origin" value="" placeholder="Origin City/Airport" />
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
                           <label>Destination *</label>
                           <input type="text" class="form-control typeahead flight_deal_destination" name="flight_deal_destination" value="" placeholder="Destination City/Airport" />
                       </div>
                   </div>
               </div>
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Date *</label>
                              <input type="text" class="form-control datetimepicker flight_deal_date" name="flight_deal_date" value="" placeholder="Flight date">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Airline *</label>
                              <input type="text" class="form-control airlineTypeAhead flight_deal_airline" name="flight_deal_airline" value="" placeholder="e.g (British Airways)">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Cabin *</label>
                              <select name="flight_deal_cabin" class="form-control flight_deal_cabin">
                                  @foreach($cabin_types as $cabin_type)
                                  <option value="{{$cabin_type->cabin_code}}">{{$cabin_type->cabin_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Other flight information</label>
                          <textarea class="form-control flight_deal_information" rows="5">

                          </textarea>
                      </div>
                  </div>
                  </div>
              </div>
              <div class="card-footer">
                <div class="col-md-12" align="right">
                    <button class="btn btn-alt-primary submit_flight_deal">Continue (Save Flight Deal)</button>
                </div>
              </div>
          </div>
      </div>
    </div>

    <div class="row hotel_deal hidden">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Hotel Deal
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hotel Star Rating *</label>
                                <select class="form-control hotel_deal_star_rating">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Hotel Name *</label>
                                <input type="text" name="hotel_deal_hotel_name"  class="form-control hotel_deal_hotel_name" placeholder="e.g Radisson Blu"/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Hotel City *</label>
                                <input type="text" name="hotel_deal_hotel_city"  class="form-control hotel_deal_hotel_city typeahead" placeholder="Hotel City Name"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(Check In) Start Date *</label>
                                <input type="text" class="form-control datepicker hotel_deal_start_date" placeholder="Customer Check in Date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(Check Out) End Date *</label>
                                <input type="text" class="form-control datepicker hotel_deal_end_date" placeholder="Customer Check Out Date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Stay Duration *(days)</label>
                                <input type="number" class="form-control hotel_deal_stay_duration">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hotel Address *</label>
                                <textarea class="form-control hotel_deal_hotel_address" rows="5">

                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hotel Information *</label>
                                <textarea class="form-control hotel_deal_hotel_information" rows="5">

                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-alt-primary submit_hotel_deal">Continue (Save Hotel Deal)</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="gallery" class="row hotel_deal_images hidden">
        <div class="col-md-12">
            <div class="card card-white">
                <div class="card-header clearfix">
                    <h4 class="card-title"><i class="fa fa-info"></i>Hotel Gallery</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['url'=>'backend/packages/storeGalleryInfo', 'method'=>'POST', 'files'=>'true', 'enctype' => 'multipart/form-data', 'class'=>'dropzone', 'id' => 'image-upload']) !!}
                    {{ Form::hidden('package_id', '', ['class'=>'package_id']) }}
                    {{ Form::hidden('parent_id', '', ['class'=>'hotel_images_parent_id']) }}
                    {{ Form::hidden('image_type_id', '1', ['class'=>'image_type_id']) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <div>
                                    <h3>Drag and Drop or Click On Box to Select Multiple Images</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <button type="button" class="btn btn-alt-primary hotel_images_complete pull-right"><i class="fa fa-check"></i> Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row attraction_deals hidden">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  Attraction
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Attraction Name *</label>
                            <input type="text" class="form-control attraction_name"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Attraction City *</label>
                            <input type="text" class="form-control attraction_city typeahead"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Attraction Date *</label>
                            <input type="text" class="form-control attraction_date datepicker"/>
                        </div>
                    </div>
                </div>
                  <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                           <label>Location Description *</label>
                           <textarea class="form-control attraction_location_description" rows="5"></textarea>
                       </div>
                   </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Attraction Additional Information *</label>
                              <textarea class="form-control attraction_information" rows="5"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header">
                                  Sight Seeings
                                  <button type="button" class="btn btn-alt-primary add_more_sight_seeing float-lg-right">Add More Sight Seeing <i class="fa fa-plus"></i></button>
                              </div>
                              <div class="card-body">
                                  <div class="sight_seeing_container">
                                      <div class="row">
                                          <input type="hidden" class="attraction_sight_seeing_id" value="">
                                          <div class="col-md-3">
                                              <label>Sight Seeing Title</label>
                                              <input class="form-control attraction_sight_seeing_title" type="text" placeholder="e.g Eiffel Tower Visit"/>
                                          </div>
                                          <div class="col-md-7">
                                              <label>Sight Seeing Description *</label>
                                              <textarea class="form-control attraction_sight_seeing_description" rows="5" placeholder="A brief or detailed explanation of what the sight seeing is about"></textarea>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card-footer">
                 <div class="row">
                     <div class="col-md-12" align="right">
                         <button type="button" class="btn btn-alt-primary submit_attraction">Continue (Save Attraction)</button>
                     </div>
                 </div>
              </div>
          </div>
      </div>
    </div>

    <div id="gallery" class="row attraction_images hidden">
        <div class="col-md-12">
            <div class="card card-white">
                <div class="card-header clearfix">
                    <h4 class="card-title"><i class="fa fa-info"></i>Attraction Gallery</h4>
                </div>
                <div class="card-body">
                    {!!Form::open(['url'=>'backend/travel-packages/storeGalleryInfo', 'method'=>'POST', 'files'=>'true', 'enctype' => 'multipart/form-data', 'class'=>'dropzone', 'id' => 'image-upload']) !!}
                    {{ Form::hidden('package_id', '', ['class'=>'package_id']) }}
                    {{ Form::hidden('parent_id', '', ['class'=>'attraction_images_parent_id']) }}
                    {{ Form::hidden('image_type_id', '2', ['class'=>'image_type_id']) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <div>
                                    <h3>Drag and Drop or Click On Box to Select Multiple Images</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <button type="button" class="btn btn-alt-primary attraction_images_complete pull-right"><i class="fa fa-check"></i> Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('javascript')
    <script src="{{asset('backend/js/pages/travel-packages.js')}}" type="text/javascript"></script>
@endsection