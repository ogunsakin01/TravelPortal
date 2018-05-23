$(function(){

    $('.cancel_pnr').on('click',function(){
        let pnr = $(this).val();
        swal({
            title: "Cancel Reservation",
            text: "Please, are you sure you want to cancel this reservation?",
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
                    text: "Yes, cancel please !!!",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        })
            .then(isConfirm => {
            if(isConfirm){
                axios.get(baseUrl+'/cancel-pnr/'+pnr)
                    .then(function(response){
                      console.log(response.data);
                      if(response.data == 1){
                          toastr.success('Reservation cancelled successfully !!!');
                          swal("Cancelled!", "Reservation has been cancelled successfully !!!", "success");
                          $('.cancel_status_'+ pnr).html('<p class="danger"><i class="la la-danger"></i> Cancelled</p>');
                      }
                      else if(response.data == 2){
                          swal("Sorry", "Unable to cancel reservation !!!", "error");
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
                        swal("Sorry", "Unable to cancel reservation !!!", "error");
                    })
            }
            else {
                swal("Not Cancelled", "Your reservation is safe", "error");
            }
        });
    });

    $('.issue_ticket').on('click',function(){
        let pnr =  $(this).val();
          swal({
            title:"Issue Ticket",
            text: "Please, are you sure you want to issue the ticket for this reservation ?",
            icon: "info",
            buttons: {
                cancel: {
                    text: "Sorry, don't !!!",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: false,
                },
                confirm: {
                    text: "Yes, issue ticket !!!",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        })
            .then(isConfirm => {
                if(isConfirm){
                    axios.get(baseUrl+'/issue-ticket/'+pnr)
                        .then(function(response){
                            console.log(response.data);
                            if(response.data == 1){
                                toastr.success('Ticket issued successfully !!!');
                                swal("Issued!", "Ticket has been issued successfully !!!", "success");
                                $('.ticket_status_'+ pnr).html('<p class="success"><i class="la la-check"></i> Issued</p>');
                            }
                            else if(response.data == 2){
                                swal("Sorry", "Unable to issue ticket !!!", "error");
                            }
                            else if(response.data == 21){
                                swal("Sorry", "Booking server did not return any information !!!", "error");
                            }
                            else if(response.data == 11){
                                swal("Sorry", "Booking server could not issue ticket !!!", "error");
                            }
                            else if(Array.isArray(response.data)){
                                let error;
                                if(Array.isArray(response.data[1])){
                                    for(let i = 0; i < response.data[1].length; i++){
                                        error = error + '<br/>'+response.data[1][1];
                                    }
                                }else{
                                    error = response.data[1];
                                }
                                swal("Sorry", error+ "!!!", "error");
                            }
                        })
                        .catch(function(error){
                            extractError(error);
                            swal("Sorry", "Unable to issue ticket !!!", "error");
                        })
                }
                else{
                    swal("Cancelled", "Issue ticket cancelled !!!", "error");
                }
            });
    });

    $('.void_ticket').on('click',function(){

    });



});