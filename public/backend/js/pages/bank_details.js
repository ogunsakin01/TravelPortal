


$('.upload-bank').on('click',function(){
   var type = $('#editOrSave').val();
   var account_name      = $('#account_name').val();
   var account_number    = $('#account_number').val();
    var bank_id          = $('#bank_id').val();
    var bank_branch      = $('#bank_branch').val();
    var bank_ifsc_code   = $('#bank_ifsc_code').val();
    var bank_pan_code    = $('#bank_pan_code').val();
    var id               = $('#bank_details_id').val();
    var editOrSave       = $('#editOrSave').val();
    var ids = [
        'account_name',
        'account_number',
        'bank_id',
        'bank_branch',
        'bank_ifsc_code',
        'bank_pan_code'
    ];
    if(!validateFormWithIds(ids)){return false;}
    $('#enter_bank_details_card_body').LoadingOverlay('show');
    axios.post(baseUrl +'/settings/bank-details/saveOrUpdate',{
        account_name      : account_name,
        account_number    : account_number,
        bank_id           : bank_id,
        bank_branch       : bank_branch,
        bank_ifsc_code    : bank_ifsc_code,
        bank_pan_code     : bank_pan_code,
        id                : id
    })
    .then(function(response){
        $('#enter_bank_details_card_body').LoadingOverlay('hide');
            var new_table_row =
                '<tr id="row_'+ response.data.id +'">' +
                '<td>'+ response.data.account_name +'</td>' +
                '<td>'+ response.data.account_number +'</td>' +
                '<td>Refresh Page ...</td>' +
                '<td>'+ response.data.bank_branch +'</td>' +
                '<td>'+ response.data.ifsc_code +'</td>' +
                '<td>'+ response.data.pan +'</td>' +
                '<td id="status_'+ response.data.id +'"><span class="badge badge-danger"><i class="fa fa-times"></i>&nbsp;DISABLED</span></td>' +
                '<td>' +
                '<button type="button" class="btn btn-success activate" value="'+ response.data.id +'"><i class="fa fa-check"></i></button>' +
                '<button type="button" class="btn btn-warning deactivate" value="'+ response.data.id +'"><i class="fa fa-times"></i></button>' +
                '<button type="button" class="btn btn-primary edit" value="'+ response.data.id +'"><i class="fa fa-edit"></i></button>' +
                /*'<button type="button" class="btn btn-danger" value="'+ response.data.id +'"><i class="fa fa-trash"></i></button>' +*/
                '</td>' +
                '</tr>' ;
        if(editOrSave == 1){
            $('#table-body').append(new_table_row);
            toastr.info('New bank details added successfully');
            $('#account_name').val('');
            $('#account_number').val('');
            $('#bank_branch').val('');
            $('#bank_ifsc_code').val('');
            $('#bank_pan_code').val('');
        }else if(editOrSave == 2){
            var new_info =
                '<td>'+ response.data.account_name +'</td>' +
                '<td>'+ response.data.account_number +'</td>' +
                '<td>Refresh Page ...</td>' +
                '<td>'+ response.data.bank_branch +'</td>' +
                '<td>'+ response.data.ifsc_code +'</td>' +
                '<td>'+ response.data.pan +'</td>' +
                '<td id="status_'+ response.data.id +'"><span class="badge badge-danger"><i class="fa fa-times"></i>&nbsp;DISABLED</span></td>' +
                '<td>' +
                '<button type="button" class="btn btn-success activate" data-toggle="title" title="Activate bank info" value="'+ response.data.id +'"><i class="fa fa-check"></i></button>' +
                '<button type="button" class="btn btn-warning deactivate" data-toggle="title" title="De-activate bank info" value="'+ response.data.id +'"><i class="fa fa-times"></i></button>' +
                '<button type="button" class="btn btn-primary edit" data-toggle="title" title="Edit bank info" value="'+ response.data.id +'"><i class="fa fa-edit"></i></button>' +
                /*'<button type="button" class="btn btn-danger" value="'+ response.data.id +'"><i class="fa fa-trash"></i></button>' +*/
                '</td>';
            $('#row_'+id).html(new_info);
            toastr.info('Bank details uploaded successfully');
            $('#bank_upload_button').text('Save');
            $('#save_header').html('Add Bank Account Details');
            $('#account_name').val('');
            $('#account_number').val('');
            $('#bank_branch').val('');
            $('#bank_ifsc_code').val('');
            $('#bank_pan_code').val('');
            $('#editOrSave').val(1);
        }

    })
    .catch(function(error){
        $('#enter_bank_details_card_body').LoadingOverlay('hide');
        extractError(error);

    })




});

$('.activate').on('click',function(){
  var id = $(this).val();
    $("#row_"+id).LoadingOverlay('show');
  axios.post(baseUrl + '/settings/bank-details/activate',{
      id : id
  })
  .then(function(response){
        $("#row_"+id).LoadingOverlay('hide');
        $('#status_'+id).html('<span class="badge badge-success"><i class="fa fa-check"></i>&nbsp;ACTIVE</span>');
        toastr.info('Bank details activated');
  })
});

$('.deactivate').on('click',function(){
    var id = $(this).val();
    $("#row_"+id).LoadingOverlay('show');
    axios.post(baseUrl + '/settings/bank-details/deActivate',{
        id : id
    })
        .then(function(response){
            $("#row_"+id).LoadingOverlay('hide');
            $('#status_'+id).html('<span class="badge badge-danger"><i class="fa fa-check"></i>&nbsp;DISABLED</span>');
            toastr.info('Bank details deactivated');
        })
});

$('.edit').on('click',function(){
   var id = $(this).val();
   axios.get(baseUrl + '/settings/bank-details/fetch/'+id)
       .then(function(response){
           $('#save_header').html('Edit bank details');
           $('#account_name').val(response.data.account_name);
           $('#account_number').val(response.data.account_number);
           $('#bank_id').val(response.data.bank_id);
           $('#bank_branch').val(response.data.bank_branch);
           $('#bank_ifsc_code').val(response.data.ifsc_code);
           $('#bank_pan_code').val(response.data.pan);
           $('#bank_details_id').val(response.data.id);
           $('#editOrSave').val(2);
           $('#bank_upload_button').text('Edit');
           toastr.info("Bank information populated");
       })
       .catch(function(error){

       });


});

// $('#delete').on('click',function(){
//     var id = $(this).val();
//     $("#row_"+id).LoadingOverlay('show');
//     axios.post(pageUrl + '/delete',{
//         id : id
//     })
//         .then(function(response){
//             $("#row_"+id).LoadingOverlay('hide');
//             $("#row_"+id).fadeIn('slow').hide();
//             toastr.info('Bank details del');
//         })
// });