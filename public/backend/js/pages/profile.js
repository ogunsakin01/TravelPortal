$(function(){

   $('#update_customer_information').on('click',function(){
       buttonClicked('update_customer_information','Update Customer Information',1);
       var sur_name       = $('input[name="customer_sur_name"]').val();
       var first_name        = $('input[name="customer_first_name"]').val();
       var other_name      = $('input[name="customer_other_name"]').val();
       var phone_number     = $('input[name="customer_phone_number"]').val();
       var address          = $('textarea[name="customer_address"]').val();
       toastr.info("Updating your information. Please hold on for some seconds ...");
       axios.post(baseUrl+'/settings/update/user/profile',{
          customer_first_name   : first_name,
          customer_sur_name    : sur_name,
          customer_other_name  : other_name,
          customer_phone_number : phone_number,
          customer_address      : address
       })
           .then(function(response){
               buttonClicked('update_customer_information','Update Customer Information',0);
               toastr.success('Profile Information Updated Successfully');
               $('.customer_full_name').text(first_name+" "+middle_name+" "+last_name);
               console.log(response.data);
           })
           .catch(function(error){
               buttonClicked('update_customer_information','Update Customer Information',0);
               extractError(error);
           })
   });

   $('#update_password').on('click',function(){
       buttonClicked('update_password','Update',1);
       var password                = $('input[name="customer_new_password"]').val();
       var confirm_password        = $('input[name="customer_new_password_confirm"]').val();
       toastr.info('Updating user password. Please hold on for some seconds ...');
      axios.post(baseUrl+"/settings/update/user/password",{
          password              : password,
          password_confirmation : confirm_password
      })
          .then(function(response){
              buttonClicked('update_password','Update',0);
              toastr.success("Customer password uploaded successfully");
              $('input[name="customer_new_password"]').val("");
              $('input[name="customer_new_password_confirm"]').val("");
              console.log(response.data);
          })
          .catch(function(error){
              buttonClicked('update_password','Update',0);
              extractError(error);
          })
   });

   $('button[name="profile_upload"]').on('click',function(){
       buttonClicked('update_image','Update',1);
       var formData = new FormData();
       var imageFile = document.querySelector('#customer_profile_photo').files[0];
       formData.append('customer_profile_photo',imageFile);
       toastr.info('Updating profile image, please hold on for some seconds ...');
       axios.post(baseUrl+'/settings/updateProfile',formData ,{
           headers: {
               'Content-Type': 'multipart/form-data'
           }
       })
           .then(function(response){
               buttonClicked('update_image','Update',0);
               console.log(response.data);
               if(response.data == 0){
                   toastr.error("Sorry, unable to upload your profile photo");
               }else{
                   toastr.success("Profile image uploaded successfully");
                   $('#user_image').prop('src',baseUrl+"/"+response.data.photo);
                   $('#customer_profile_photo').val("");
               }
           })
           .catch(function(error){
               buttonClicked('update_image','Update',0);
               extractError(error);
           })
   });

});