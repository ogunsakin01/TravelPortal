/**
 * Created by hp on 9/1/2018.
 */


$(function () {

  $('#save_markup').click(function () {
    buttonClicked('save_markup',$('#save_markup').text(),1);
    var role = $('#role').val();
    var markup_type = $('#markup_type').val();
    var markup_value_type = $('#markup_value_type').val();
    var markup_value = $('#markup_value').val();

    axios.post(baseUrl+ '/settings/markup/admin', {
      'role': role,
      'markup_type': markup_type,
      'markup_value_type': markup_value_type,
      'markup_value': markup_value
    })
    .then(function (response) {
        buttonClicked('save_markup',$('#save_markup').text(),0);
      if(response.data == 1){
        location.reload();
        toastr.success('Markup saved successfully')
      }
      else{
        toastr.error('Could not save markup');
      }
    })

    .catch(function (error) {
        buttonClicked('save_markup','Save',0);
        extractError(error);
    })
  });

  $('.edit_markup').click(function(){
    $('#header_info').text('Edit Markup Information');
    $('#save_markup').text('Edit');
    var data = $(this).val();
    var id =  data.split('_')[0];
    var type = data.split('_')[1];
    axios.get(baseUrl +'/settings/getMarkup/'+id)
        .then(function(response){
           if(type === "flight"){
             var markup_type       = 1;
             var markup_value_type = response.data.flight_markup_type;
             var markup_value      = response.data.flight_markup_value;
           }else if(type === 'hotel'){
               var markup_type       = 2;
               var markup_value_type = response.data.hotel_markup_type;
               var markup_value      = response.data.hotel_markup_value;
           }else if(type === 'car'){
               var markup_type       = 3;
               var markup_value_type = response.data.car_markup_type;
               var markup_value      = response.data.car_markup_value;
           }
          $('#role').val(response.data.role_id);
          $('#markup_type').val(markup_type);
          $('#markup_value_type').val(markup_value_type);
          $('#markup_value').val(markup_value);
          toastr.info('Markup info populated');
        })
        .catch(function(error){
            extractError(error);
        });
  });

});

function fetchMarkups()
{

}