var pageUrl = '/backend/additions';


$(function(){
    $('#add_markdown').on('click',function(){
        buttonClicked('createOrUpdate',$('#add_markdown').text(),1);
        var ids = ['airline','value_type','value'];
        if(!validateFormWithIds(ids)){
            buttonClicked('createOrUpdate',$('#add_markdown').text(),0);
            return false;
        }
        var airline    = $('#airline').val();
        var value_type = $('#value_type').val();
        var value      = $('#value').val();

        axios.post(pageUrl+'/createOrUpdateMarkdown',{
            airline    : airline,
            value_type : value_type,
            value      : value
        })
            .then(function(response){
                buttonClicked('createOrUpdate',$('#add_markdown').text(),0);

                if(response.data === 0){
                    toastr.error('Sorry, you cannot add a markdown for this airline');
                    return false;
                }
                toastr.success('Airline information uploaded');
                window.location.href = pageUrl+'/markdown';
                console.log(response.data);
            })
            .catch(function(error){
                buttonClicked('createOrUpdate',$('#add_markdown').text(),0);
                extractError(error);
            })

    });

    $('.edit').on('click',function(){
        var id = $(this).val();
        axios.get(pageUrl+'/getMarkdown/'+id)
            .then(function(response){
               console.log(response.data);
               $('#airline').val(response.data.airline_name);
               $('#value').val(response.data.value);
               $('#value_type').val(response.data.type);
               toastr.info('Markdown info populated');
               $('#markdown_header').text('Edit Markdown');
               $('#add_markdown').text('Edit Markdown');
            })
            .catch(function(error){

            })
    });
});
