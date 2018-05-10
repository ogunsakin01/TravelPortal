$(function(){

    function flightInformationLoader(status) {
        if(status === 1){
            $('.site-wrapper').addClass('hidden');
            $('.flight_information_loader').removeClass('hidden');
        }
        if(status === 0){
            $('.site-wrapper').removeClass('hidden');
            $('.flight_information_loader').addClass('hidden');
        }
    }

    function extractError(error){
        for(var error_log in error.response.data.errors){
            var err = error.response.data.errors[error_log];
            toastr.error(err);
        }
    }

    $('.show-available-airlines').on('click',function(){
        $('.available-airlines').fadeIn('slow',function(){
            $(this).toggleClass('hidden-sm').toggleClass('hidden-xs');
        });
    });

    $('.show-available-stops').on('click',function(){
        $('.available-stops').fadeIn('slow',function(){
            $(this).toggleClass('hidden-sm').toggleClass('hidden-xs');
        });
    });

    $('.show-available-cabins').on('click',function(){
        $('.available-cabins').fadeIn('slow',function(){
            $(this).toggleClass('hidden-sm').toggleClass('hidden-xs');
        });
    });

    $('.open-search').on('click',function(){
        $('.search-holder').fadeIn('slow',function(){
            $(this).toggleClass('hidden-sm').toggleClass('hidden-xs');
        });
    });

    $('.select').on('click',function(){

        if($(this).hasClass('stops')){
            $('.stops').not(this).prop('checked',false);
        }

        if($(this).hasClass('airlines')){
            $('.airlines').not(this).prop('checked',false);
        }

        if($(this).hasClass('cabins')){
            $('.cabins').not(this).prop('checked',false);
        }

        var filterParamClasses = [];
        var data = '';

        if( $('.select:checkbox:checked').length < 1){
            $('.all-itinerary').removeClass('hidden');
            return false;
        }
        else{
            $('.select:checkbox:checked').each(function () {
                var thisVal = (this.checked ? $(this).val() : "");
                filterParamClasses.push(thisVal);
                data = data+"."+thisVal;
            });
        }

        if($(data).length < 1){
            toastr.warning("No itinerary matching your options found. Try again");
        }
        else{
                $('.all-itinerary').addClass('hidden');
                $(data).removeClass('hidden');
        }

    });

    $('#price_filter').ionRangeSlider({
        type: "double",
        min: minPrice,
        max: maxPrice,
        grid: true,
        step: 10000,
        force_edges: true,
        onStart: function (data) {
       },
       onChange: function (data) {

       },
       onFinish: function (data) {
            var available = 0;
           for(var j = 0; j < prices.length; j++){
               if((prices[j] >= data.from) && (prices[j] <= data.to)){
                   available = +available + 1;
               }
           }
           if(available < 1){
               toastr.warning("No itinerary within that price range available");
               return false;
           }

           toastr.info(available+ "itineraries found");
            for(var i = 0; i < prices.length; i++){
                if((prices[i] >= data.from) && (prices[i] <= data.to)){
                        $('.'+prices[i]+'-price').removeClass('hidden');
                }
                else{
                        $('.'+prices[i]+'-price').addClass('hidden');
                }
                $('.select').prop('checked',false);
            }
       },
       onUpdate: function(data){

       }
});

    $('.continue').on('click',function(){
        var serial = $(this).val();
        toastr.info("Contacting the booking server on the availability of this Itinerary. It will take just few seconds");
        axios.get(baseUrl+'/selected-itinerary-info/'+serial)
            .then(function(response){
                console.log(response.data);
                $('.displayAirline').html(response.data.displayAirline);
                $('.cabinType').html(response.data.cabinType);
                $('.stops').html(response.data.stops+" stop(s)");
                $('.totalPricing').html('&#x20a6;'+ (response.data.displayTotal / 100));
            });
         flightInformationLoader(1);
        axios.get(baseUrl+'/get-flight-information-and-pricing/'+serial)
            .then(function(response){
                console.log(response.data);
                if(response.data == 1){
                    toastr.success('Itinerary available. Redirecting to booking page ...');
                    window.location.href = baseUrl+'/itinerary-booking';
                }else{
                    if(response.data == 2){
                        toastr.error('Sorry !!! This Itinerary is not longer available, please choose another Itinerary');
                    }else if(response.data == 0){
                        toastr.error('Bad Internet Connection, unable to connect to the booking server');
                    }else{
                        toastr.error('Sorry !!! This Itinerary is not longer available, please choose another Itinerary');
                    }
                flightInformationLoader(0);
                }
            })
            .catch(function(error){
                extractError(error);
                flightInformationLoader(0);
            })

    });




});