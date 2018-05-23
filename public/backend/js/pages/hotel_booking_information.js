$(function(){

    $('.retry_booking').on('click',function(){
        let reference = $(this).val();
        swal({
            title: "Rebook Room",
            text: "Hi there, are you sure you want to retry booking the hotel room ?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "No, please don't !!!",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: false,
                },
                confirm: {
                    text: "Yes, Retry Booking !!!",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        })

            .then(isConfirm => {
                if(isConfirm){
                    axios.get(baseUrl+'/bookings/hotel/rebook-hotel-room/'+reference)
                        .then(function(response){
                            console.log(response.data);
                            if(response.data == 1){
                                toastr.success('Hotel room booked successfully !!!');
                                swal("Cancelled!", "Hotel room booked successfully !!!", "success");
                                $('.cancel_status_'+ pnr).html('<p class="danger"><i class="la la-danger"></i> Cancelled</p>');
                            }
                            else if(response.data == 2){
                                swal("Sorry", "Unable to rebook hotel room !!!", "error");
                            }
                            else if(response.data == 21){
                                swal("Sorry", "Booking server did not return any information concerning this reservation !!!", "error");
                            }
                            else if(Array.isArray(response.data)){
                                let error;
                                if(Array.isArray(response.data[1])){
                                    for(let i = 0; i < response.data[1].length; i++){
                                        error = error+'<br/>'+response.data[1][1];
                                    }
                                }else{
                                    error = response.data[1];
                                }
                                swal("Sorry", error+ "!!!", "error");
                            }
                        })
                        .catch(function(error){
                            extractError(error);
                            swal("Sorry", "Unable to rebook hotel room !!!", "error");
                        })
                }
                else {
                    swal("Not Booked", "The hotel room remains unbooked by you", "error");
                }
            });

    });

});