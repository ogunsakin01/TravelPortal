$(function(){
    $('.generate_wallet_payment').on('click',function(){
        let classes = ['amount'];
        if(!validateFormWithClasses(classes)){
            return false;
        }
        let amount = $('.amount').val();
        buttonClassClicked('generate_wallet_payment','GENERATE PAYMENT',1);
        toastr.info('Generating payment, please hold on for some seconds');
        // toastr.info(amount);
        axios.post(baseUrl+'/backend/generate-interswitch-wallet-payment',{
            amount : amount,
        })
            .then(function(response){
                $('.reference').val(response.data.reference);
                $('.hash').val(response.data.hash);
                $('.redirect_url').val(response.data.redirect_url);
                $('.actual_amount').val(response.data.amount);
                $('.amount').prop('disabled',true);

                $('.generate_wallet_payment').addClass('hidden');
                $('.interswitch_pay_now').removeClass('hidden');
                toastr.success("Thank you for your patience. Click on the pay now button to continue");
                buttonClassClicked('generate_wallet_payment','GENERATE PAYMENT',0);
            })
            .catch(function(error){
                extractError(error);
                buttonClassClicked('generate_wallet_payment','GENERATE PAYMENT',0);
            })
    });
});