$(function(){

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
        toastr.info(serial);
        axios.get(baseUrl+'/selected-itinerary-info/'+serial)
            .then(function(response){
                console.log(response.data);
                $('.displayAirline').html(response.data.displayAirline);
                $('.cabinType').html(response.data.cabinType);
                $('.stops').html(response.data.stops+" stop(s)");
                $('.totalPricing').html('&#x20a6;'+ (response.data.displayTotal / 100));
            });

        axios.get(baseUrl+'/get-flight-information-and-pricing/'+serial)
            .then(function(response){
                console.log(response.data);
            })
            .catch(function(error){

            })

    });

});

