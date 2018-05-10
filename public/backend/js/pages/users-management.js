$(function(){
    $('.delete_user').on('click',function(){
        let user_id = $(this).val();
        toastr.info(user_id);
        swal({
            title:"Delete User!",
            text:"Bookings related to this user will still be retained in the database ,are you sure you want to delete user, ?",
            icon:'warning',
            buttons:{
                cancel: {
                    text: "Please, don't !!!",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: false,
                },
                confirm: {
                    text: "Yes, Delete user !!!",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
        })
            .then(isConfirm => {
                if(isConfirm){

                    axios.get(baseUrl+'/settings/users/delete-user/'+user_id)
                        .then(function(response){
                            console.log(response.data);
                            if(response.data.delete_status == 1){
                                $('.user_id_'+user_id).fadeIn('slow',function(){
                                   $(this).remove();
                                });
                                swal("Success","User deleted successfully!!!","success");
                            }else if(response.data.delete_status == 0){
                                swal("Sorry","Unable to delete user!!!","error");
                            }
                        })
                        .catch(function(error){
                            extractError(error);
                            swal("Sorry", "Unable to delete user from the system !!!", "error");
                        })
                }
                else{
                    swal("Cancelled", "User is safe, not deleted", "info");
                }
            });
    });
});