$(function(){

    function extractError(error) {
        for(var error_log in error.response.data.errors) {
            var err = error.response.data.errors[error_log];
            toastr.error(err);
        }
    }

    function validateFormWithClasses(classes) {
        if (Array.isArray(classes))
        {
            for(var i=0; i < classes.length; i++)
            {
                var result = 0;
                if($("."+classes[i]).length > 1){
                    $("."+classes[i]).each(function() {
                        if($(this).val() === "" || $(this).val() === null)
                        {
                            $(this).css("border-color", "red");
                            result++;
                        }else{
                            $(this).css("border-color", "green");
                        }
                    });
                    if (result > 0){
                        toastr.error("Please fill all highlighted field(s)");
                        return false;
                    }
                }else{
                    if($("."+classes[i]).val() === "" || $("."+classes[i]).val() === null)
                    {
                        $("."+classes[i]).css("border-color", "red");
                        result++;
                    }else{
                        $("."+classes[i]).css("border-color", "green");
                    }
                    if (result > 0){
                        toastr.error("Please fill all highlighted field(s)");
                        return false;
                    }
                }

            }

        }else if(typeof classes === 'string')
        {
            if($("."+classes).length > 1){
                $("."+classes).each(function() {
                    if($(this).val() === "" || $(this).val() === null)
                    {
                        $(this).css("border-color", "red");
                        result++;
                    }else{
                        $(this).css("border-color", "green");
                    }
                });
                if (result > 0){
                    toastr.error("Please fill all highlighted field(s)");
                    return false;
                }
            }else{
                if($("."+classes).val() === "" || $("."+classes).val() === null)
                {
                    $("."+classes).css("border-color", "red");
                    toastr.error("Please fill all highlighted field(s)");
                    return false;
                }else{
                    $("."+classes).css("border-color", "green");
                }

            }
        }
        return true;
    }

    $('.continue').on('click',function(){
        $('.nav-tabs a[href="#passenger-info"]').tab('show');
    });

    $('.sign-in').on('click',function(){
       $('.sign-in-container').fadeIn('fast',function(){
           $(this).toggleClass('hidden');
       });
        $('.sign-up-container').fadeIn('fast',function(){
            $(this).toggleClass('hidden');
        });
    });

    $('.sign-in-submit').on('click',function(){
        var classes = ['login_email','login_password'];
        if(!validateFormWithClasses(classes)){
            return false;
        }
        var email    = $('.login_email').val();
        var password = $('.login_password').val();

        buttonClassClicked('sign-in-submit','Sign In',1);

        axios.post(baseUrl+'/custom-sign-in',{
            email    : email,
            password : password
        })
            .then(function(response){
                console.log(response.data);
                if(response.data === false){
                    toastr.error('Incorrect login details. Please try again');
                }else{
                    toastr.success('Login Successful.');
                    $('.sign-up-container').fadeIn('slow',function(){
                        $(this).remove();
                    });
                    $('.sign-in-container').fadeIn('slow',function(){
                        $(this).remove();
                    });
                    $('.login-box').fadeIn('slow',function(){
                        $(this).remove();
                    });
                    $('.passenger-detail').removeClass('hidden');
                }
                buttonClassClicked('sign-in-submit','Sign In',0);
            })
            .catch(function(error){
                extractError(error);
                buttonClassClicked('sign-in-submit','Sign In',0);
            })


    });

    $('.sign-up-submit').on('click',function(){
        var classes = ['sur_name','first_name','other_name','register_email','register_phone','password','password_confirmation'];
        if(!validateFormWithClasses(classes)){
            return false;
        }
        var sur_name               = $('.sur_name').val();
        var first_name             = $('.first_name').val();
        var other_name             = $('.other_name').val();
        var register_email         = $('.register_email').val();
        var register_phone         = $('.register_phone').val();
        var password               = $('.password').val();
        var password_confirmation  = $('.password_confirmation').val();

        buttonClassClicked('sign-up-submit','Sign Up',1);

        axios.post(baseUrl+'/custom-sign-up',{
            sur_name               : sur_name,
            first_name             : first_name,
            other_name             : other_name,
            email                  : register_email,
            phone                  : register_phone,
            password               : password,
            password_confirmation  : password_confirmation
        })

        .then(function(response){
                console.log(response.data);
                buttonClassClicked('sign-up-submit','Sign Up',0);
                if(response.data === false){
                    toastr.error('Sorry, unable to log you in after registration. Please try again');
                }else{
                    toastr.success('Registration and login successful.');
                    $('.sign-up-container').fadeIn('slow',function(){
                        $(this).remove();
                    });
                    $('.sign-in-container').fadeIn('slow',function(){
                        $(this).remove();
                    });
                    $('.login-box').fadeIn('slow',function(){
                        $(this).remove();
                    });
                    $('.passenger-detail').removeClass('hidden');
                }
            })

        .catch(function(error){
                extractError(error);
                buttonClassClicked('sign-up-submit','Sign Up',0);

            })

    });

});