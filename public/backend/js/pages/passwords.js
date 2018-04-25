/**
 * Created by hp on 10/1/2018.
 */


$(function () {

  $('#send_link').click(function () {
    var email = $('#email').val();

    axios.post('/backend/password/reset', {
      'email': email
    })
        .then(function (response) {
          if (response.data == 1)
          {
            toastr.success('Password reset link sent');
            window.location.href = baseUrl+'/backend/login';
          }
          else if(response.data == 0)
          {
            toastr.error('Could not send email. Check your email and try again');
          }

          console.log(response);
        })
        .catch(function (error) {
          extractError(error);
        })
  });

  $('#change_password').click(function () {
    var ids = ['old_password','new_password','confirm_password'];
    if(!validateFormWithIds(ids)){
      return false;
    }
    var old_password = $('#old_password').val();
    var new_password = $('#new_password').val();
    var confirm_password = $('#confirm_password').val();
    buttonClicked('send_link','Change',1);
    axios.post('/backend/password/change', {
      'old_password': old_password,
      'new_password': new_password,
      'confirm_password': confirm_password
    })
    .then(function (response) {
        buttonClicked('send_link','Change',0);
      if (response.data == 1)
      {
        $('#old_password').val("");
        $('#new_password').val("");
        $('#confirm_password').val("");
        toastr.success('Password changed successfully');
      }
      else if (response.data == 0)
      {
        toastr.error('Could not change password. Try again!');
      }
      else if (response.data == 2)
      {
        toastr.error('Incorrect password. Try again!');
      }
    })
    .catch(function (error) {
        buttonClicked('send_link','Change',0);
      extractError(error);
    })
  });

});