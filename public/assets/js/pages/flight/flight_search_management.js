$(function(){

    var departure_city = $('.multi_destination_departure_city');

    var destination_city = $('.multi_destination_destination_city');

    var departure_date = $('.multi_destination_departure_date');

    var originDestinations = [];

    var newTrip = '<div class="this-trip">' +
        '<div class="col-md-4 col-sm-4 search-col-padding ">\n' +
        '                                                    <div class="form-group">\n' +
        '                                                        <label>Departure City</label>\n' +
        '                                                        <input type="text" name="departure_city" class="form-control multi_destination_departure_city type-ahead" required placeholder="E.g. London">\n' +
        '                                                    </div>\n' +
        '                                                </div>\n' +
        '                                                <div class="col-md-4 col-sm-4 search-col-padding">\n' +
        '                                                    <div class="form-group">\n' +
        '                                                        <label>Destination City</label>\n' +
        '                                                        <input type="text" name="destination_city" class="form-control multi_destination_destination_city type-ahead" required placeholder="E.g. New York">\n' +
        '                                                    </div>\n' +
        '                                                </div>\n' +
        '                                                <div class="col-md-3 col-sm-3 search-col-padding">\n' +
        '                                                    <div class="form-group">\n' +
        '                                                        <label>Departure Date</label>\n' +
        '                                                        <input type="text" class="form-control multi_destination_departure_date date-picker" name="departure_date" placeholder="DD/MM/YYYY">\n' +
        '                                                    </div>\n' +
        '                                                </div>\n' +
        '                                                <div class="col-md-1 col-sm-1 search-col-padding">\n' +
        '\n' +
        '                                                    <div class="form-group">\n' +
        '                                                        <label>&nbsp;</label>\n' +
        '                                                        <button class="btn btn-danger btn-sm btn-group remove" type="button">Remove <i class="fa fa-minus"></i></button>\n' +        '    ' +
        '                                                     </div>\n' +
        '                                                </div>\n' +
        '                                                <div class="clearfix"></div> ' +
        '</div>';

    function validateFormWithClasses(classes) {
        if (Array.isArray(classes))
        {
            for(var i=0; i < classes.length; i++)
            {
                var result = 0;
                if($("."+classes[i]).length > 1){
                    $("."+classes[i]).each(function() {
                        if($(this).val() === "" || $(this).val() === null)
                        {
                            $(this).css("border-color", "red");
                            result++;
                        }else{
                            $(this).css("border-color", "green");
                        }
                    });
                    if (result > 0){
                        toastr.error("Please fill all highlighted field(s)");
                        return false;
                    }
                }else{
                    if($("."+classes[i]).val() === "" || $("."+classes[i]).val() === null)
                    {
                        $("."+classes[i]).css("border-color", "red");
                        result++;
                    }else{
                        $("."+classes[i]).css("border-color", "green");
                    }
                    if (result > 0){
                        toastr.error("Please fill all highlighted field(s)");
                        return false;
                    }
                }

            }

        }else if(typeof classes === 'string')
        {
            if($("."+classes).length > 1){
                $("."+classes).each(function() {
                    if($(this).val() === "" || $(this).val() === null)
                    {
                        $(this).css("border-color", "red");
                        result++;
                    }else{
                        $(this).css("border-color", "green");
                    }
                });
                if (result > 0){
                    toastr.error("Please fill all highlighted field(s)");
                    return false;
                }
            }else{
                if($("."+classes).val() === "" || $("."+classes).val() === null)
                {
                    $("."+classes).css("border-color", "red");
                    toastr.error("Please fill all highlighted field(s)");
                    return false;
                }else{
                    $("."+classes).css("border-color", "green");
                }

            }
        }
        return true;
    }

    function fillDepartureCity(){
        var length = $('.multi_destination_departure_city').length;
        var latest = length - 1;
        var previous = length - 2;
        $($('.multi_destination_departure_city')[latest]).val($($('.multi_destination_destination_city')[previous]).val());
    }

    function extractError(error) {
        for(var error_log in error.response.data.errors) {
            var err = error.response.data.errors[error_log];
            toastr.error(err);
        }
    }

    function flightSearchLoader(status,data) {

        $('.search_departure_city').text(data['departure_city']);
        $('.search_destination_city').text(data['destination_city']);
        $('.search_departure_date').text(data['departure_date']);
        $('.search_return_date').text(data['return_date']);
        $('.search_num_of_adult').text(data['no_of_adult']);
        $('.search_num_of_child').text(data['no_of_child']);
        $('.search_num_of_infant').text(data['no_of_infant']);
        // $('.search_cabin').text(data['cabin']);

         if(status === 1){
           $('.site-wrapper').addClass('hidden');
           $('.flight_search_loader').removeClass('hidden');
         }
         if(status === 0){
             $('.site-wrapper').removeClass('hidden');
             $('.flight_search_loader').addClass('hidden');
         }
    }

    function flightMultiSearchLoader(status) {
        if(status === 1){
            $('.site-wrapper').addClass('hidden');
            $('.flight_multi_search_loader').removeClass('hidden');
        }
        if(status === 0){
            $('.site-wrapper').removeClass('hidden');
            $('.flight_multi_search_loader').addClass('hidden');
        }
    }

    $.LoadingOverlaySetup({
        color           : "rgba(255, 255, 255, 0.8)",
        image           : baseUrl+"/images/preloaders/general.gif",
        maxSize         : "50px",
        minSize         : "30px",
        resizeInterval  : 0,
        size            : "15%"
    });

    $('#add_new_trip').on('click',function(){
        var validateClasses = ['multi_destination_departure_city','multi_destination_destination_city','multi_destination_departure_date'];
      if(!validateFormWithClasses(validateClasses)){
          return false;
      }


        $('.multi_destination_origin_destinations').append($(newTrip));

        $('.type-ahead').typeahead({
            source: function (query, process) {
                return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });

        $('.remove').on('click',function(){
            $(this).closest('.this-trip').fadeIn('slow',function(){
                $(this).remove();
            });
        });

        var length = $('.multi_destination_departure_date').length;
        var previous = length - 2;
        var now = length - 1;
        var date = $($('.multi_destination_departure_date')[previous]).datepicker('getDate');
        var tempDate = new Date(date);
        var tempYear = tempDate.getFullYear();
        var tempMonth = tempDate.getMonth() + 1;
        var tempDay = tempDate.getDate() +1 ;
        var newDate = tempMonth + '/' + tempDay + '/' + tempYear;
        $($('.multi_destination_departure_date')[now]).datepicker({minDate : newDate}).val(newDate);

        fillDepartureCity();
    });

    $('.one_way_departure_date').datepicker({minDate: -0});

    $('.round_trip_departure_date').datepicker({minDate: -0});

    $('.round_trip_departure_date').on('change paste keyup',function(){

        var date = $(this).val();
        var tempDate = new Date(date);
        var tempYear = tempDate.getFullYear();
        var tempMonth = tempDate.getMonth() + 1;
        var tempDay = tempDate.getDate() +1 ;
        var newDate = tempMonth + '/' + tempDay + '/' + tempYear;
        $('.round_trip_return_date').datepicker({minDate : newDate}).val(newDate);

    });

    $('input[name="inlineRadioOptions"][type="radio"]').on('change',function(){
        var option = $(this).val();
        toastr.info($(this).val());
        if(option === "One Way"){
           $('#one_way_flight_search_holder').removeClass('hidden');
           $('#round_trip_flight_search_holder').addClass('hidden');
           $('#multi_destination_flight_search_holder').addClass('hidden');
        }

        if(option === "Round Trip"){
            $('#one_way_flight_search_holder').addClass('hidden');
            $('#round_trip_flight_search_holder').removeClass('hidden');
            $('#multi_destination_flight_search_holder').addClass('hidden');
        }

        if(option === "Multi Destination"){
            $('#one_way_flight_search_holder').addClass('hidden');
            $('#round_trip_flight_search_holder').addClass('hidden');
            $('#multi_destination_flight_search_holder').removeClass('hidden');
        }


    });

    $('.multi_destination_search_flight').on('click',function(){
        var validateClasses = ['multi_destination_departure_city','multi_destination_destination_city','multi_destination_departure_date'];
        if(!validateFormWithClasses(validateClasses)){
            return false;
        }

        var length = $('.multi_destination_departure_city').length;
        if(length > 0){
            for(var i = 0; i < length; i++){
                var originDestination = {
                    departure_city : $($('.multi_destination_departure_city')[i]).val(),
                    destination_city : $($('.multi_destination_destination_city')[i]).val(),
                    departure_date : $($('.multi_destination_departure_date')[i]).val()
                };
                originDestinations.push(originDestination);
            }
        }else{
            return false;
        }
        var searchParam = {
            no_of_adult  : $('.multi_destination_adult_count').val(),
            no_of_child  : $('.multi_destination_child_count').val(),
            no_of_infant : $('.multi_destination_infant_count').val()
        };

        flightMultiSearchLoader(1);
        toastr.info('Please hold on, contacting booking server for available Itineraries ...');
        axios.post(baseUrl+'/multi-destination-flight-search',{
            originDestinations : originDestinations,
            searchParam        : searchParam
        })
            .then(function(response){
                originDestinations = [];
                console.log(response.data);
                if(response.data == 1){
                    toastr.success('Search completed, redirecting to available Itineraries ...');
                    window.location.href = baseUrl+'/available-itineraries';
                }else{
                    if(response.data == 2){
                        toastr.error('Oops !!! We did not find any available itinerary. Please try again with different options');
                    }else if(response.data == 0){
                        toastr.error('Bad Internet Connection, unable to connect to the booking server');
                    }else{
                        toastr.error('Oops !!! We did not find any available itinerary. Please try again with different options');
                    }
                    flightMultiSearchLoader(0);
                }
            })
            .catch(function(error){
                originDestinations = [];
                flightMultiSearchLoader(0);
                extractError(error);
            })

    });

    $('.one_way_search_flight').on('click',function(){
        var validateClasses = ['one_way_departure_city','one_way_destination_city','one_way_departure_date'];
        if(!validateFormWithClasses(validateClasses)){
            return false;
        }

        var departure_city    = $('.one_way_departure_city').val();
        var destination_city  = $('.one_way_destination_city').val();
        var departure_date    = $('.one_way_departure_date').val();
        var no_of_adult       = $('.one_way_adult_count').val();
        var no_of_child       = $('.one_way_child_count').val();
        var no_of_infant      = $('.one_way_infant_count').val();
        // var cabin             = $('.one_way_cabin').val();

        var searchData         = [];
        searchData['departure_city']   = departure_city;
        searchData['destination_city'] = destination_city;
        searchData['departure_date']   = departure_date;
        searchData['return_date']      = "One Way Flight";
        searchData['no_of_adult']      = no_of_adult;
        searchData['no_of_child']      = no_of_child;
        searchData['no_of_infant']     = no_of_infant;
        // searchData['cabin']            = cabin;

        toastr.info('Please hold on, contacting booking server for available Itineraries ...');
        flightSearchLoader(1,searchData);
        axios.post(baseUrl+"/one-way-flight-search",{
            departure_city      : departure_city,
            destination_city    : destination_city,
            departure_date      : departure_date,
            return_date         : 'Not Available',
            no_of_adult         : no_of_adult,
            no_of_child         : no_of_child,
            no_of_infant        : no_of_infant
        })
            .then(function(response){
                console.log(response.data)
                if(response.data == 1){
                    toastr.success('Search completed, redirecting to available Itineraries ...');
                    window.location.href = baseUrl+'/available-itineraries';
                }
                else{
                    if(response.data == 2){
                        toastr.error('Oops !!! We did not find any available itinerary. Please try again with different options');
                    }else if(response.data == 0){
                        toastr.error('Bad Internet Connection, unable to connect to the booking server');
                    }else{
                        toastr.error('Oops !!! We did not find any available itinerary. Please try again with different options');
                    }
                    flightSearchLoader(0,searchData);
                }
            })
            .catch(function(error){
              flightSearchLoader(0,searchData);
              extractError(error);
            })
    });

    $('.round_trip_search_flight').on('click',function(){
        var validateClasses = ['round_trip_departure_city','round_trip_destination_city','round_trip_departure_date','round_trip_return_date'];
        if(!validateFormWithClasses(validateClasses)){
            return false;
        }

        var departure_city    = $('.round_trip_departure_city').val();
        var destination_city  = $('.round_trip_destination_city').val();
        var departure_date    = $('.round_trip_departure_date').val();
        var return_date       = $('.round_trip_return_date').val();
        var no_of_adult       = $('.round_trip_adult_count').val();
        var no_of_child       = $('.round_trip_child_count').val();
        var no_of_infant      = $('.round_trip_infant_count').val();
        // var cabin             = $('.round_trip_cabin').val();

        var searchData         = [];
        searchData['departure_city']   = departure_city;
        searchData['destination_city'] = destination_city;
        searchData['departure_date']   = departure_date;
        searchData['return_date']      = return_date;
        searchData['no_of_adult']      = no_of_adult;
        searchData['no_of_child']      = no_of_child;
        searchData['no_of_infant']     = no_of_infant;
        // searchData['cabin']            = cabin;

        toastr.info('Please hold on, contacting booking server for available Itineraries ...');
        flightSearchLoader(1,searchData);
        axios.post(baseUrl+"/round-trip-flight-search",{
            departure_city      : departure_city,
            destination_city    : destination_city,
            departure_date      : departure_date,
            return_date         : return_date,
            no_of_adult         : no_of_adult,
            no_of_child         : no_of_child,
            no_of_infant        : no_of_infant
            // cabin               : cabin
        })
            .then(function(response){
                console.log(response.data);
                if(response.data == 1){
                    toastr.success('Search completed, redirecting to available Itineraries ...');
                    window.location.href = baseUrl+'/available-itineraries';
                }else{
                    if(response.data == 2){
                        toastr.error('Oops !!! We did not find any available itinerary. Please try again with different options');
                    }else if(response.data == 0){
                        toastr.error('Bad Internet Connection, unable to connect to the booking server');
                    }else{
                        toastr.error('Oops !!! We did not find any available itinerary. Please try again with different options');
                    }
                    flightSearchLoader(0,searchData);
                }

            })
            .catch(function(error){
                flightSearchLoader(0,searchData);
                extractError(error);
            })



    });

});