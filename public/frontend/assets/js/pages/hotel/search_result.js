$(function(){

    function hotelInformationLoader(status, hotelName){
        if(status === 1){
            $('.site-wrapper').addClass('hidden');
            $('.hotel_information_loader').removeClass('hidden');
            $('.selected_hotel_name').text(hotelName);
        }
        if(status === 0){
            $('.site-wrapper').removeClass('hidden');
            $('.hotel_information_loader').addClass('hidden');
        }
    }

    $('.show-star-ratings').on('click',function(){
        $('.available-star-ratings').fadeIn('slow',function(){
            $(this).toggleClass('hidden-sm').toggleClass('hidden-xs');
        });
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
                toastr.warning("No hotel within that price range available");
                return false;
            }

            toastr.info(available+ " hotel(s) found");
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

    $('.select').on('click',function(){
        let rating = $(this).val();
        if(rating == 'all'){
            $('.select').prop('checked',false);
        }else{
            $('.cabins').not(this).prop('checked',false);
            var filterParamClasses = [];
            var data = '';
            if( $('.select:checkbox:checked').length < 1){
                $('.all-hotel').removeClass('hidden');
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
                toastr.warning("No hotel matching your options found. Try again");
            }
            else{
                $('.all-hotel').addClass('hidden');
                $(data).removeClass('hidden');
            }
        }
    });

    $('.select_hotel').on('click',function(){
       let hotel = $(this).val();
       toastr.info(hotel);
       axios.get(baseUrl+'/get-selected-hotel-information/'+hotel)
            .then(function(response){
                console.log(response.data);
                hotelInformationLoader(1,response.data.hotelName);
            })

       axios.get(baseUrl+'/get-selected-hotel-rooms-information/'+hotel)
           .then(function(response){
               console.log(response.data);
               if(response.data == 1){
                   toastr.success("Hotel information retrieved, redirecting to hotel information page");
                   window.location.href = baseUrl+'/hotel-information';
               }
               else{
                   if(response.data == 2){
                       toastr.error('Sorry !!! Unable to get hotel information. Kindly select another hotel');
                   }else if(response.data == 0){
                       toastr.error('Bad Internet Connection, unable to connect to the booking server');
                   }else{
                       toastr.error('Sorry !!! Unable to get hotel information. Kindly select another hotel ');
                   }
               }
               hotelInformationLoader(0,'No Hotel');
           })
           .catch(function(error){
               hotelInformationLoader(0,'No Hotel');
               extractError(error);
           })
    });



});