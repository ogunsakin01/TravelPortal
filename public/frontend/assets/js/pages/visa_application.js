$(function(){
    $('.submit_visa_application').on('click',function(){
        let classes = ['visa_sur_name','visa_given_name','visa_phone','visa_email','visa_residency_country','visa_destination_country'];
        if(!validateFormWithClasses(classes)){return false;}
        let surname             = $('.visa_sur_name').val();
        let given_name          = $('.visa_given_name').val();
        let phone               = $('.visa_phone').val();
        let email               = $('.visa_email').val();
        let residency_country   = $('.visa_residency_country').val();
        let destination_country = $('.visa_destination_country').val();
        if(!isEmail(email)){toastr.error('Enter a valid email');return false;}
        buttonClassClicked('submit_visa_application','SUBMIT APPLICATION', 1);
        axios.post(baseUrl+'/visa-application',{
            surname             : surname,
            given_name          : given_name,
            phone               : phone,
            email               : email,
            residency_country   : residency_country,
            destination_country : destination_country
        })
            .then(function(response){
                console.log(response.data);
                if(response.data == 0){
                    toastr.error('Sorry, unable to send your visa application request. Try again later.');
                }else if(response.data == 1){
                    toastr.success('Your application was received, our visa application programme team will get bak to you shortly');
                    $('.visa_sur_name').val("");
                    $('.visa_given_name').val("");
                    $('.visa_phone').val("");
                    $('.visa_email').val("");
                    $('.visa_residency_country').val("");
                    $('.visa_destination_country').val("");
                }else{
                    toastr.info('Unable to send visa application request. Try again later','Server Error !!!');
                }
                buttonClassClicked('submit_visa_application','SUBMIT APPLICATION',0)
            })
            .catch(function(error){
                extractError(error);
                buttonClassClicked('submit_visa_application','SUBMIT APPLICATION',0)
            })
    })
});