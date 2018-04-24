$(function(){

    function hotelSearchLoader(status,data) {

        $('.hotel_destination_city').text(data);

        if(status === 1){
            $('.site-wrapper').addClass('hidden');
            $('.hotel_search_loader').removeClass('hidden');
        }
        if(status === 0){
            $('.site-wrapper').removeClass('hidden');
            $('.hotel_search_loader').addClass('hidden');
        }
    }

    $('.check_in_date').on('change paste keyup',function(){

        var date = $(this).val();
        var tempDate = new Date(date);
        var tempYear = tempDate.getFullYear();
        var tempMonth = tempDate.getMonth() + 1;
        var tempDay = tempDate.getDate() +1 ;
        var newDate = tempMonth + '/' + tempDay + '/' + tempYear;
        $('.check_out_date').datepicker({minDate : newDate}).val(newDate);

    });

    $('.hotel_search').on('click',function(){
        var classes = ['hotel_city','check_in_date','check_out_date','adult_count','child_count'];

        if(!validateFormWithClasses(classes)){
            return false;
        }

        var hotel_city = $('.hotel_city').val();
        var check_in_date = $('.check_in_date').val();
        var check_out_date = $('.check_out_date').val();
        var adult_count     = $('.adult_count').val();
        var child_count     = $('.child_count').val();
         hotelSearchLoader(1,hotel_city);
         toastr.info('Contacting the booking server for available hotels at the location you selected.');
        axios.post(baseUrl+'/searchHotel',{
            hotel_city     : hotel_city,
            check_in_date  : check_in_date,
            check_out_date : check_out_date,
            adult_count    : adult_count,
            child_count    : child_count
        })
            .then(function(response){
                console.log(response.data);
                hotelSearchLoader(0,hotel_city);
            })
            .catch(function(error){
                extractError(error);
                hotelSearchLoader(0,hotel_city);
            })
    });

});