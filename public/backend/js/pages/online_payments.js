$(function(){

    $('.requery').on('click',function(){
        let id = $(this).val();
        swal({
            title: "Requery",
            text: "Please, are you sure you want to requery the transaction?",
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
                    text: "Yes, please !!!",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        })
            .then(isConfirm => {
                if(isConfirm){
                    axios.get(baseUrl+'/transactions/requery/'+id)
                        .then(function(response){
                            console.log(response.data);
                            if(response.data.status == 1){
                             $('.response_code_'+id).html(response.data.responseCode);
                             $('.response_description_'+id).html(response.data.responseDescription);
                             $('.payment_status_'+id).html('<p class="success"><i class="la la-check"></i> Successful</p>');
                                swal("Successful", response.data.responseDescription, "Success");
                            }
                            else{
                               if(response.data.responseCode != '--'){
                                   $('.response_code_'+id).html(response.data.responseCode);
                                   $('.response_description_'+id).html(response.data.responseDescription);
                                   $('.payment_status_'+id).html('<p class="warning"><i class="la la-warning"></i> Pending</p>');
                                   if(response.data.responseDescription == null){
                                       swal("Sorry", "Payment server returned no information", "error");
                                   }else{
                                       swal("Sorry", response.data.responseDescription, "error");
                                   }
                               }else{
                                   swal("Sorry", response.data.responseDescription, "error");
                               }
                            }
                        })
                        .catch(function(error){
                            extractError(error);
                            swal("Sorry", "Unable to requery booking !!!", "error");
                        })
                }
                else {
                    swal("Not Requeried", "", "error");
                }
            });
    });


});