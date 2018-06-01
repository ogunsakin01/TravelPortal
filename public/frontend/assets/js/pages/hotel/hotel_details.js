$(function(){

    function hotelRoomInformationLoader(status, hotelName){
        if(status === 1){
            $('.site-wrapper').addClass('hidden');
            $('.hotel_room_information_loader').removeClass('hidden');
            $('.selected_hotel_name').text(hotelName);
        }
        if(status === 0){
            $('.site-wrapper').removeClass('hidden');
            $('.hotel_room_information_loader').addClass('hidden');
        }
    }

    $('.select_room').on('click',function(){

      var id = $(this).val();

      axios.get(baseUrl+'/selected-hotel-information')
          .then(function(response){
              toastr.info('Contacting the booking server for the selected room information, please hold on for some seconds ...')
           hotelRoomInformationLoader(1,response.data.hotelName);
          })
          .catch(function(error){
              extractError(error);
          });



      axios.get(baseUrl+'/get-selected-hotel-room-information/'+id)
          .then(function(response){
           console.log(response.data);
              if(response.data == 1){
                  toastr.success("Hotel room information retrieved, redirecting to hotel room information page");
                  window.location.href = baseUrl+'/hotel-room-information/'+id;
              }
              else{
                  if(response.data == 2){
                      toastr.error('Sorry !!! Unable to get hotel room information. Kindly select another hotel room or go back and select another hotel');
                  }else if(response.data == 0){
                      toastr.error('Bad Internet Connection, unable to connect to the booking server');
                  }else{
                      toastr.error('Sorry !!! Unable to get hotel room information. Kindly select another hotel room or go back and select another hotel');
                  }
              }
           hotelRoomInformationLoader(0,'No hotel selected');
          })
          .catch(function(error){
            extractError(error);
              hotelRoomInformationLoader(0,'No hotel selected');
          })

    });

});