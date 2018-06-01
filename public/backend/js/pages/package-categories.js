
$('.activate').on('click',function(){
    var id = $(this).val();
    axios.post(baseUrl+'/backend/travel-packages/activate/category',{
        id : id
    })
        .then(function(response){
            if(response.data === 1){
                $('#status_'+id).html('<span class="badge badge-success"><i class="fa fa-check"></i> Active</span>');
                toastr.success('Category activated');
            }else if(response.data === 2){
                $('#status_'+id).html('<span class="badge badge-success"><i class="fa fa-check"></i> Active</span>');
                toastr.info('Category is currently active');
            }
        })
        .catch(function(error){
            extractError(error)
        });
});

$('.deActivate').on('click',function(){
    var id = $(this).val();
    axios.post(baseUrl+'/backend/travel-packages/deActivate/category',{
        id : id
    })
        .then(function(response){
            if(response.data === 1){
                $('#status_'+id).html('<span class="badge badge-danger"><i class="fa fa-times"></i> Disabled</span>');
                toastr.success('Category deactivated');
            }else if(response.data === 2){
                $('#status_'+id).html('<span class="badge badge-danger"><i class="fa fa-times"></i> Disabled</span>');
                toastr.error('Category is currently not active');
            }
        })
        .catch(function(error){
            extractError(error)
        });
});