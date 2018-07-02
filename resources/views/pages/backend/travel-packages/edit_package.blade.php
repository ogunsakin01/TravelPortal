@extends('layouts.backend')

@section('page-title') Edit {{$package->name}} | Travel Packages @endsection

@section('content')

    <input type="hidden" value="{{$package->id}}" class="package_id"/>



    <input type="hidden" value="{{$package->flight}}" class="flight"/>
    <input type="hidden" value="{{$package->hotel}}" class="hotel"/>
    <input type="hidden" value="{{$package->attraction}}" class="attraction"/>


    <div class="row base_package">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <i class="fa fa-info-circle"></i>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Note !!!</strong> all fields are required.
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
                                <label>&nbsp;</label>
                                <input type="checkbox" name="package_options[]" class="checkbox package_options"  @if($package->flight == 1) checked="checked" @endif  disabled value="flight"> Flight
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <input type="checkbox" name="package_options[]" class="checkbox package_options"  @if($package->hotel == 1) checked="checked" @endif disabled="" value="hotel"> Hotel
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <input type="checkbox" name="package_options[]" class="checkbox package_options"  @if($package->attraction == 1) checked="checked" @endif disabled value="attraction"> Attraction
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <lable>Package Name *</lable>
                                <input type="text" class="form-control package_name" name="package_name" value="{{$package->name}}" placeholder="e.g (Exclusive Dubai Vacation)" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <lable>Select Category *</lable>
                                <select class="form-control package_category" name="package_category">
                                    <option value="{{$package->category_id}}">{{\App\PackageCategory::find($package->category_id)->category}}</option>
                                    @foreach($package_categories as $package_category)
                                        <option value="{{$package_category->id}}">{{$package_category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <lable>Contact Number *</lable>
                                <input type="text" class="form-control package_contact_number" name="package_contact_number" value="{{$package->phone_number}}" placeholder="e.g (+234 801 000 1234)" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Brief Package Information *</label>
                                <textarea class="form-control package_information" rows="5" name="package_information" placeholder="A brief or detailed explanation on the package. This information will be visible to the user.">
{{$package->name}}{{$package->information}}
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
                                <input type="number" value="{{$package->adult_price}}" class="form-control adult_price" name="adult_price" placeholder="e.g 100000"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(&#x20A6;) Child Price *</label>
                                <input type="number" value="{{$package->child_price}}" class="form-control child_price" name="child_price" placeholder="e.g 100000"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(&#x20A6;) Infant Price *</label>
                                <input type="number" value="{{$package->infant_price}}" class="form-control infant_price" name="infant_price" placeholder="e.g 100000"/>
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

    @if($package->flight == 1)
        @if(is_null($flightDeal) || empty($flightDeal))
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
                                        <textarea class="form-control flight_deal_information" rows="5"></textarea>
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
            @else
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
                                <input type="text" class="form-control typeahead flight_deal_origin" name="flight_deal_origin" value="{{$flightDeal->origin}}" placeholder="Origin City/Airport" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Destination *</label>
                                <input type="text" class="form-control typeahead flight_deal_destination" name="flight_deal_destination" value="{{$flightDeal->destination}}" placeholder="Destination City/Airport" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date *</label>
                                <input type="text" class="form-control datetimepicker flight_deal_date" name="flight_deal_date" value="{{$flightDeal->date}}" placeholder="Flight date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Airline *</label>
                                <input type="text" class="form-control airlineTypeAhead flight_deal_airline" name="flight_deal_airline" value="{{$flightDeal->airline}}" placeholder="e.g (British Airways)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cabin *</label>
                                <select name="flight_deal_cabin" class="form-control flight_deal_cabin">
                                    <option value="{{$flightDeal->cabin}}">{{\App\CabinType::getCabinByCode($flightDeal->cabin)->cabin_name}}</option>
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
                                  {{$flightDeal->information}}
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
            @endif
    @endif


    @if($package->hotel == 1)
        @if(is_null($hotelDeal) || empty($hotelDeal))
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
                                        <input type="text" name="hotel_deal_hotel_name" value=""  class="form-control hotel_deal_hotel_name" placeholder="e.g Radisson Blu"/>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Hotel City *</label>
                                        <input type="text" name="hotel_deal_hotel_city" value="" class="form-control hotel_deal_hotel_city typeahead" placeholder="Hotel City Name"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>(Check In) Start Date *</label>
                                        <input type="text" class="form-control datepicker hotel_deal_start_date" value="" placeholder="Customer Check in Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>(Check Out) End Date *</label>
                                        <input type="text" class="form-control datepicker hotel_deal_end_date" value="" placeholder="Customer Check Out Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Stay Duration *(days)</label>
                                        <input type="number" class="form-control hotel_deal_stay_duration" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hotel Address *</label>
                                        <textarea class="form-control hotel_deal_hotel_address" rows="5">             </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hotel Information *</label>
                                        <textarea class="form-control hotel_deal_hotel_information" rows="5"></textarea>
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
            <div class="row hotel_deal_images hidden">
                <div class="col-md-12">
                    <div class="card card-white">
                        <div class="card-header clearfix">
                            <h4 class="card-title"><i class="fa fa-info"></i>Add more Hotel Images Gallery</h4>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['url'=>'backend/travel-packages/storeGalleryInfo', 'method'=>'POST', 'files'=>'true', 'enctype' => 'multipart/form-data', 'class'=>'dropzone', 'id' => 'image-upload']) !!}
                            <input type="hidden" value="{{$package->id}}" name="package_id" class="package_id"/>
                            <input type="hidden" value="" name="parent_id" class="hotel_images_parent_id"/>
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
            @else
    <input type="hidden" value="{{$hotelDeal->id}}" class="hotel_id"/>
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
                                    <option value="{{$hotelDeal->star_rating}}">{{$hotelDeal->star_rating}}</option>
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
                                <input type="text" name="hotel_deal_hotel_name" value="{{$hotelDeal->name}}"  class="form-control hotel_deal_hotel_name" placeholder="e.g Radisson Blu"/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Hotel City *</label>
                                <input type="text" name="hotel_deal_hotel_city" value="{{$hotelDeal->city}}" class="form-control hotel_deal_hotel_city typeahead" placeholder="Hotel City Name"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(Check In) Start Date *</label>
                                <input type="text" class="form-control datepicker hotel_deal_start_date" value="{{$hotelDeal->stay_start_date}}" placeholder="Customer Check in Date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(Check Out) End Date *</label>
                                <input type="text" class="form-control datepicker hotel_deal_end_date" value="{{$hotelDeal->stay_end_date}}" placeholder="Customer Check Out Date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Stay Duration *(days)</label>
                                <input type="number" class="form-control hotel_deal_stay_duration" value="{{$hotelDeal->stay_duration}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hotel Address *</label>
                                <textarea class="form-control hotel_deal_hotel_address" rows="5">
                                  {{$hotelDeal->address}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hotel Information *</label>
                                <textarea class="form-control hotel_deal_hotel_information" rows="5">
                                  {{$hotelDeal->information}}
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
    <div class="row hotel_deal_images hidden">
        @foreach( \App\Gallery::getGalleryByParentId($hotelDeal->id) as $i => $hotel_image)
            <div class="col-xl-3 col-md-6 col-sm-12" id="image_{{$hotel_image->id}}">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <img class="card-img img-fluid mb-1" src="{{asset($hotel_image['image_path'])}}" alt="Card image cap">
                            <h4 class="card-title">Image path</h4>
                            <p class="card-text">{{$hotel_image['image_path']}}</p>
                            <button type="button" class="btn btn-outline-teal delete_image" value="{{$hotel_image->id}}"> <i class="la la-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
        <div class="col-md-12">
            <div class="card card-white">
                <div class="card-header clearfix">
                    <h4 class="card-title"><i class="fa fa-info"></i>Add more Hotel Images Gallery</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['url'=>'backend/travel-packages/storeGalleryInfo', 'method'=>'POST', 'files'=>'true', 'enctype' => 'multipart/form-data', 'class'=>'dropzone', 'id' => 'image-upload']) !!}
                    <input type="hidden" value="{{$package->id}}" name="package_id" class="package_id"/>
                    <input type="hidden" value="{{$hotelDeal->id}}" name="parent_id" class="hotel_images_parent_id"/>
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
            @endif
    @endif


    @if($package->attraction == 1)
        @if(is_null($attraction) || empty($attraction))
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
                                        <input type="text" value="" class="form-control attraction_name"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Attraction City *</label>
                                        <input type="text" value="" class="form-control attraction_city typeahead"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Attraction Date *</label>
                                        <input type="text" value="" class="form-control attraction_date datepicker"/>
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
                                            <div class="row sight_seeing_container">
                                                    <div class="col-md-4">
                                                        <label>Sight Seeing Title</label>
                                                        <input class="form-control attraction_sight_seeing_title" value="" type="text" placeholder="e.g Eiffel Tower Visit"/>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label>Sight Seeing Description *</label>
                                                        <textarea class="form-control attraction_sight_seeing_description" rows="5" placeholder="A brief or detailed explanation of what the sight seeing is about"></textarea>
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
            <div class="row attraction_images hidden">
                <div class="col-md-12">
                    <div class="card card-white">
                        <div class="card-header clearfix">
                            <h4 class="card-title"><i class="fa fa-info"></i>Attraction Gallery</h4>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['url'=>'backend/travel-packages/storeGalleryInfo', 'method'=>'POST', 'files'=>'true', 'enctype' => 'multipart/form-data', 'class'=>'dropzone', 'id' => 'image-upload']) !!}
                            <input type="hidden" value="{{$package->id}}" name="package_id" class="package_id"/>
                            <input type="hidden" value="" name="parent_id" class="attraction_images_parent_id"/>
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
        @else
            <input type="hidden" value="{{$attraction->id}}" class="attraction_id"/>
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
                                        <input type="text" value="{{$attraction->name}}" class="form-control attraction_name"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Attraction City *</label>
                                        <input type="text" value="{{$attraction->city}}" class="form-control attraction_city typeahead"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Attraction Date *</label>
                                        <input type="text" value="{{$attraction->date}}" class="form-control attraction_date datepicker"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Location Description *</label>
                                        <textarea class="form-control attraction_location_description" rows="5">
                                    {{$attraction->address}}
                                </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Attraction Additional Information *</label>
                                        <textarea class="form-control attraction_information" rows="5">
                                    {{$attraction->information}}
                                </textarea>
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
                                                @foreach(\App\SightSeeing::getSightseeingByPackageId($package->id) as $s => $sight_seeing)
                                                    <input type="hidden" class="attraction_sight_seeing_id" value="{{$sight_seeing->id}}">
                                                    <div class="row sight_seeing_{{$sight_seeing->id}}">
                                                        <div class="col-md-3">
                                                            <label>Sight Seeing Title</label>
                                                            <input class="form-control attraction_sight_seeing_title" value="{{$sight_seeing->title}}" type="text" placeholder="e.g Eiffel Tower Visit"/>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label>Sight Seeing Description *</label>
                                                            <textarea class="form-control attraction_sight_seeing_description" rows="5" placeholder="A brief or detailed explanation of what the sight seeing is about"> {{$sight_seeing->description}} </textarea>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button class="btn btn-danger delete_sight_seeing" value="{{$sight_seeing->id}}"><i class="la la-trash"></i></button>
                                                        </div>
                                                    </div>
                                                @endforeach
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
            <div class="row attraction_images hidden">
                @foreach( \App\Gallery::getGalleryByParentId($attraction->id) as $i => $attraction_image)
                    <div class="col-xl-3 col-md-6 col-sm-12" id="image_{{$attraction_image->id}}">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <img class="card-img img-fluid mb-1" src="{{asset($attraction_image['image_path'])}}" alt="Card image cap">
                                    <h4 class="card-title">Image path</h4>
                                    <p class="card-text">{{$attraction_image['image_path']}}</p>
                                    <button type="button" class="btn btn-outline-teal delete_image" value="{{$attraction_image->id}}"> <i class="la la-trash"></i> Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    <div class="card card-white">
                        <div class="card-header clearfix">
                            <h4 class="card-title"><i class="fa fa-info"></i>Attraction Gallery</h4>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['url'=>'backend/travel-packages/storeGalleryInfo', 'method'=>'POST', 'files'=>'true', 'enctype' => 'multipart/form-data', 'class'=>'dropzone', 'id' => 'image-upload']) !!}
                            <input type="hidden" value="{{$package->id}}" name="package_id" class="package_id"/>
                            <input type="hidden" value="{{$attraction->id}}" name="parent_id" class="attraction_images_parent_id"/>
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
        @endif
    @endif


@endsection
@section('javascript')
    <script src="{{asset('backend/js/pages/travel-packages.js')}}" type="text/javascript"></script>
@endsection