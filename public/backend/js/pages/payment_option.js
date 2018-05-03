$(function(){

   $('.confirm_interswitch_booking').on('click',function(){
     var amount = $('.amount').val();
     var booking_reference = $('.booking_reference').val();
     var button_text = $('.confirm_interswitch_booking').text();
     buttonClassClicked('confirm_interswitch_booking',button_text,1);
     toastr.info("Please hold on for some seconds");
     axios.post(baseUrl+'/backend/generate-interswitch-payment',{
         amount            : amount,
         booking_reference : booking_reference
     })
         .then(function(response){
             $('.reference').val(response.data.reference);
             $('.hash').val(response.data.hash);
             $('.redirect_url').val(response.data.redirect_url);
             $('.confirm_interswitch_booking').addClass('hidden');
             $('.interswitch_pay_now').removeClass('hidden');
             toastr.success("Thank you for your patience. Click on the pay now button to pay");
             buttonClassClicked('confirm_interswitch_booking',button_text,0);
         })
         .catch(function(error){
             extractError(error);
             buttonClassClicked('confirm_interswitch_booking',button_text,0);
         })
   });

});