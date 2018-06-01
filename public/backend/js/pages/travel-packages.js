/**
 * Created by UniQue on 1/24/2018.
 */

function packageCreateComplete(){
    var flight     = $('.flight').val();
    var hotel      = $('.hotel').val();
    var attraction = $('.attraction').val();
    if(flight == 0 && hotel == 0 && attraction == 0){
        toastr.info("Travel package creation complete. Redirecting to travel package menu");
        window.location.href = baseUrl+'/backend/travel-packages';
    }
}

function activate(id) {
    $.ajax({
        type: "GET",
        url: baseUrl + '/backend/travel-packages/activate/' + id,
        success: function (response) {
            console.log(response.status);

            if (response.status == true) {
                $('#status' + id).empty();
                $('#status' + id).html("<span disabled class='btn btn-success btn-xs'>Activated</span>");
                toastr.success("Package has been activated");
            }else if(response.status == false)
            {
                toastr.error("Error: Something went wrong, package not activated, try again later");
            }else if(response.status == 'activated')
            {
                toastr.warning("Package already activated");
            }
        }
    });
}

function deactivate(id) {
    $.ajax({
        type: "GET",
        url: baseUrl + '/backend/travel-packages/deactivate/' + id,
        success: function (response) {
            console.log(response.status);

            if (response.status == true) {
                $('#status' + id).empty();
                $('#status' + id).html("<span disabled class='btn btn-danger btn-xs'>Deactivated</span>");
                toastr.success("Package has been deactivated");
            }else if(response.status == false)
            {
                toastr.error("Error: Something went wrong, package not deactivated, try again later");
            }else if(response.status == 'deactivated')
            {
                toastr.warning("Package already deactivated");
            }
        }
    });
}

$('.typeahead').typeahead({
    source: function (query, process) {
        return $.get(path, { query: query }, function (data) {
            return process(data);
        });
    }
});

$('.airlineTypeAhead').typeahead({
    source: function (query, process) {
        return $.get(airline_path, { query: query }, function (data) {
            return process(data);
        });
    }
});

$('.datepicker').datepicker();

$('.create_new_package').on('click',function(){

    var classes = [
        'package_name',
        'package_contact_number',
        'package_information',
        'adult_price',
        'child_price'
    ];
    if (!validateFormWithClasses(classes)){
        return false;
    }
    var options        = $('.package_options:checked').map(function() {return this.value;}).get().join(',');
    var name           = $('.package_name').val();
    var category       = $('.package_category').val();
    var contact_number = $('.package_contact_number').val();
    var information    = $('.package_information').val();
    var adult_price    = $('.adult_price').val();
    var child_price    = $('.child_price').val();
    var infant_price   = $('.infant_price').val();
    var package_id     = $('.package_id').val();
    if(infant_price == null || infant_price == ""){
        infant_price = 0;
    }
    if(options == "" || options == null){
        toastr.warning("You must select at least one package option");
        return false;
    }


        $('.base_package').LoadingOverlay('show');
        axios.post(baseUrl+'/backend/travel-packages/createPackage',{
        options        : options,
        name           : name,
        category       : category,
        contact_number : contact_number,
        information    : information,
        adult_price    : adult_price,
        child_price    : child_price,
        infant_price   : infant_price,
        package_id     : package_id
    })
    .then(function(response){
        $('.base_package').LoadingOverlay('hide');

        $('.base_package').addClass('hidden');

        toastr.success("Package Created. Continue to add more information");

        $('.package_id').val(response.data.id);
        $('.flight').val(response.data.flight);
        $('.hotel').val(response.data.hotel);
        $('.attraction').val(response.data.attraction);

        if(response.data.flight == 1){
           $('.flight_deal').removeClass('hidden');
        }
        if(response.data.hotel == 1){
            $('.hotel_deal').removeClass('hidden');
        }
        if(response.data.attraction == 1){
            $('.attraction_deals').removeClass('hidden');
        }
    })
    .catch(function(error){

    })
});

$('.add_more_sight_seeing').on('click',function(){
    var to_append = '<div class="col-md-4"><label>Sight Seeing Title</label><input class="form-control attraction_sight_seeing_title" type="text" placeholder="e.g Eiffel Tower Visit"/> </div> <div class="col-md-8"> <label>Sight Seeing Description *</label> <textarea class="form-control attraction_sight_seeing_description" rows="5" placeholder="A brief or detailed explanation of what the sight seeing is about"></textarea> </div>';
    $('.sight_seeing_container').append(to_append);
});

$('.submit_flight_deal').on('click',function(){

    var classes = [
        'flight_deal_origin',
        'flight_deal_destination',
        'flight_deal_date',
        'flight_deal_airline',
        'flight_deal_cabin',
        'flight_deal_information'
    ];
    if (!validateFormWithClasses(classes)){
        return false;
    }

    var origin      = $('.flight_deal_origin').val();
    var destination = $('.flight_deal_destination').val();
    var date        = $('.flight_deal_date').val();
    var airline     = $('.flight_deal_airline').val();
    var cabin       = $('.flight_deal_cabin').val();
    var information = $('.flight_deal_information').val();
    var package_id  = $('.package_id').val();
    $('.flight_deal').LoadingOverlay("show");
    axios.post(baseUrl+'/backend/travel-packages/createFlightDeal',{
        origin      : origin,
        destination : destination,
        date        : date,
        airline     : airline,
        cabin       : cabin,
        information : information,
        package_id  : package_id
    })
    .then(function(response){
        $('.flight_deal').LoadingOverlay("hide");
        $('.flight_deal').addClass('hidden');
        $('.flight').val(0);
        packageCreateComplete();
    })
    .catch(function(error){
        $('.flight_deal').LoadingOverlay("hide");
    })

});

$('.submit_hotel_deal').on('click',function(){
    var classes = [
        'hotel_deal_star_rating',
        'hotel_deal_hotel_name',
        'hotel_deal_hotel_city',
        'hotel_deal_start_date',
        'hotel_deal_end_date',
        'hotel_deal_stay_duration',
        'hotel_deal_hotel_address',
        'hotel_deal_hotel_information'
    ];
    if (!validateFormWithClasses(classes)){
        return false;
    }
    var hotel_rating  = $('.hotel_deal_star_rating').val();
    var hotel_name    = $('.hotel_deal_hotel_name').val();
    var hotel_city    = $('.hotel_deal_hotel_city').val();
    var start_date    = $('.hotel_deal_start_date').val();
    var end_date      = $('.hotel_deal_end_date').val();
    var stay_duration = $('.hotel_deal_stay_duration').val();
    var address       = $('.hotel_deal_hotel_address').val();
    var information   = $('.hotel_deal_hotel_information').val();
    var package_id    = $('.package_id').val();

      $('.hotel_deal').LoadingOverlay("show");
      axios.post(baseUrl+'/backend/travel-packages/createHotelDeal',{
          hotel_name      : hotel_name,
          hotel_city      : hotel_city,
          hotel_rating    : hotel_rating,
          start_date      : start_date,
          end_date        : end_date,
          duration        : stay_duration,
          hotel_address   : address,
          information     : information,
          package_id      : package_id
      })
      .then(function(response){
          $('.hotel_deal').LoadingOverlay("hide");
          $('.hotel_deal').addClass('hidden');
          $('.hotel_images_parent_id').val(response.data.id);
          toastr.info("Hotel information has been uploaded, proceed to upload hotel images");
          $('.hotel_deal_images').removeClass("hidden");
          packageCreateComplete();

      })
      .catch(function(error){

      })

});

$('.hotel_images_complete').on('click',function(){
    toastr.success("Your hotel image and hotel information has been successfully uploaded");
    $('.hotel').val(0);
    $('.hotel_deal_images').addClass('hidden');
    packageCreateComplete();
});

$('.submit_attraction').on('click',function(){
    var classes = [
        'attraction_sight_seeing_description',
        'attraction_sight_seeing_title',
        'attraction_name',
        'attraction_city',
        'attraction_location_description',
        'attraction_information'
                  ];
    if (!validateFormWithClasses(classes)){
       return false;
    }
    var name                    = $('.attraction_name').val();
    var city                    = $('.attraction_city').val();
    var date                    = $('.attraction_date').val();
    var location_description    = $('.attraction_location_description').val();
    var information             = $('.attraction_information').val();
    var package_id              = $('.package_id').val();
    var attraction_titles       = $('.attraction_sight_seeing_title').map(function() {return this.value;}).get().join(',');
    var attraction_descriptions = $('.attraction_sight_seeing_description').map(function() {return this.value;}).get().join(',');
    $('.attraction_deals').LoadingOverlay("show");

     axios.post(baseUrl+'/backend/travel-packages/createAttraction',{
         package_id                : package_id,
         name                      : name,
         address                   : location_description,
         date                      : date,
         information               : information,
         city                      : city,
         sight_seeing_titles       : attraction_titles,
         sight_seeing_descriptions : attraction_descriptions
     })
     .then(function(response){
         $('.attraction_deals').LoadingOverlay("hide");
         $('.attraction_deals').addClass('hidden');
         $('.attraction_images_parent_id').val(response.data.id);
         toastr.info("Attraction information has been uploaded, proceed to upload attraction images");
         $('.attraction_images').removeClass("hidden");
         packageCreateComplete();

     })
     .catch(function(error){

     })

});

$('.attraction_images_complete').on('click',function(){

    toastr.success("Your attraction image and attraction information has been successfully uploaded");
    $('.attraction').val(0);
    $('.attraction_images').addClass('hidden');
    packageCreateComplete();

});

$('.delete_image').on('click', function(){
    var id = $(this).val();
    $('#image_'+id).LoadingOverlay("show");
    axios.post(baseUrl+'/backend/travel-packages/delete-image',{id:id})
        .then(function(){
            $('#image_'+id).LoadingOverlay("hide");
            $('#image_'+id).addClass('hidden');
        })
});

