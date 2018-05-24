$(function(){

    $('.approve').on('click',function(){
        let id = $(this).val();
        axios.get(baseUrl+'/transactions/update-payment-status/'+id+'/'+1)
            .then(function(response){
                if(response.data == 1){
                    toastr.success("Payment status updated successfully");
                    $('.status_'+id).html('<p class="success"> Approved</p>');
                    location.reload();
                }else{
                    toastr.error("Unable to update payment status");
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.decline').on('click',function(){
        let id = $(this).val();
        axios.get(baseUrl+'/transactions/update-payment-status/'+id+'/'+0)
            .then(function(response){
                if(response.data == 1){
                    toastr.success("Payment status updated successfully");
                    $('.status_'+id).html('<p class="danger"> Declined</p>');
                    location.reload();
                }else{
                    toastr.error("Unable to update payment status");
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

});