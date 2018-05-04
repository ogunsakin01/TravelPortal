$(function(){
    
    $('#create_voucher').on('click',function(){
       var amount = $('#voucher_amount').val();
       var voucher_id = $('#voucher_id').val();
       var voucher_code = $('#voucher_code').val();
       var ids = ['voucher_amount'];
       if(!validateFormWithIds(ids)){
           return false;
       }
       buttonClicked('create_voucher',' Save',1);
       axios.post(baseUrl+'/settings/create/voucher',{
           voucher_id : voucher_id,
           amount : amount,
           voucher_code : voucher_code
       })
           .then(function(response){
               console.log(response.data);
               buttonClicked('create_voucher',' Save',0);
               if(response.data == 0){
                 toastr.error('Sorry, unable to save voucher information.');
               }else{
                   toastr.success('Voucher information saved successfully.');
                   var table_row = '  <tr>\n' +
                       '                            <td><b>'+ response.data.code +'</b></td>\n' +
                       '                            <td>'+ (response.data.amount/100) +'</td>\n' +
                       '                            <td id="status_'+ response.data.id +'">\n' +
                       '                                <span class="badge badge-danger">Disabled </span>\n' +
                       '                            </td>\n' +
                       '                            <td>\n' +
                       '                                <button class="btn btn-info btn-sm activate" value="'+ response.data.id  +'"> Activate</button>\n' +
                       '                                <button class="btn btn-danger btn-sm delete" value="'+ response.data.id +'">  Delete</button>\n' +
                       '                            </td>\n' +
                       '                        </tr>';
                   $('#vouchers_table_body_new').prepend(table_row);
                   $('#voucher_amount').val("");
                   $('#voucher_id').val("");
                   $('#voucher_code').val("");

                   location.reload();

               }
           })
           .catch(function(error){
               extractError(error);
               buttonClicked('create_voucher',' Save',0);
           })
    });

    $('#voucher_amount').on('keyup',function(){

      if($(this).val() == "" || $(this).val() == null){
          $('#voucher_amount').val("");
          $('#voucher_id').val("");
          $('#voucher_code').val("");
          $('#voucher_card_title').val("Create Voucher");
      }

    });

    $('.edit').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl+"/settings/get/voucher/"+id)
            .then(function(response){
                console.log(response.data);
                toastr.info("Voucher information populated. Please, edit.");
                $('#voucher_id').val(response.data.id);
                $('#voucher_code').val(response.data.code);
                $('#voucher_amount').val((response.data.amount/100));
                $('#voucher_card_title').val("Edit Voucher");
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.give_out').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl+"/settings/give_out/voucher/"+id)
            .then(function(response){

                if(response.data == 0){
                    toastr.error("Sorry, unable to update the voucher status");
                }else{
                    toastr.success("Voucher status updated successfully");
                    $('#status_'+id).html('<span class="badge badge-info">Given Out</span>\n');
                    $('#action_'+id).html("");
                }

            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.activate').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl+"/settings/activate/voucher/"+id)
            .then(function(response){
                if(response.data == 0){
                    toastr.error("Sorry, unable to update the voucher status");
                }else{
                    toastr.success("Voucher status updated successfully");
                    $('#status_'+id).html('<span class="badge badge-primary">Active</span>\n');
                    $('#action_'+id).html(
                        '<button class="btn btn-warning btn-sm disable" value="'+id+'">   Disable  </button>'+
                        '<button class="btn btn-primary btn-sm give_out" value="'+id+'">  Give Out </button>'
                    );
                    location.reload();
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.disable').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl+"/settings/disable/voucher/"+id)
            .then(function(response){
                if(response.data == 0){
                    toastr.error("Sorry, unable to update the voucher status");
                }else{
                    toastr.success("Voucher status updated successfully");
                    $('#status_'+id).html('<span class="badge badge-warning">Disabled</span>\n');
                    $('#action_'+id).html(
                        '<button class="btn btn-info btn-sm activate" value="'+ id +'"> Activate </button>' +
                        '<button class="btn btn-danger btn-sm delete" value="'+ id +'"> Delete </button>\n'
                    );
                    $('.activate').on('click',function(){
                        var id = $(this).val();
                        axios.get(baseUrl+"/settings/activate/voucher/"+id)
                            .then(function(response){
                                if(response.data == 0){
                                    toastr.error("Sorry, unable to update the voucher status");
                                }else{
                                    toastr.success("Voucher status updated successfully");
                                    $('#status_'+id).html('<span class="badge badge-primary">Active</span>\n');
                                    $('#action_'+id).html(
                                        '<button class="btn btn-warning btn-sm disable" value="'+id+'">   Disable  </button>'+
                                        '<button class="btn btn-primary btn-sm give_out" value="'+id+'">  Give Out </button>'
                                    );
                                    location.reload();
                                }
                            })
                            .catch(function(error){
                                extractError(error);
                            })
                    });
                    $('.delete').on('click',function(){
                        var id = $(this).val();
                        axios.get(baseUrl+"/settings/delete/voucher/"+id)
                            .then(function(response){
                                if(response.data == 10){
                                    toastr.error("Sorry, unable to delete voucher");
                                }else if(response.data == 11){
                                    toastr.success("Voucher deleted successfully");
                                    $('#row_'+id).fadeIn('slow',function(){
                                        $(this).remove();
                                    });
                                }else if(response.data == 1){
                                    toastr.info("Sorry, you need to disable the voucher before you can delete");
                                }
                                else if(response.data == 2){
                                    toastr.info("Sorry, this voucher has been used and is need for record purpose");
                                }
                                else if(response.data == 3){
                                    toastr.info("Sorry, this voucher has been given out already");
                                }
                            })
                            .catch(function(error){
                                extractError(error);
                            })
                    });
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

    $('.delete').on('click',function(){
        var id = $(this).val();
        axios.get(baseUrl+"/settings/delete/voucher/"+id)
            .then(function(response){
                if(response.data == 10){
                    toastr.error("Sorry, unable to delete voucher");
                }else if(response.data == 11){
                    toastr.success("Voucher deleted successfully");
                    $('#row_'+id).fadeIn('slow',function(){
                      $(this).remove();
                    });
                }else if(response.data == 1){
                    toastr.info("Sorry, you need to disable the voucher before you can delete");
                }
                else if(response.data == 2){
                    toastr.info("Sorry, this voucher has been used and is need for record purpose");
                }
                else if(response.data == 3){
                    toastr.info("Sorry, this voucher has been given out already");
                }
            })
            .catch(function(error){
                extractError(error);
            })
    });

});