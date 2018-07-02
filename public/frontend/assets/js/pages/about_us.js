$(function(){
    $('.submit_comment').on('click',function(){
        let classes = ['comment_name','comment_email','comment_content'];
        if(!validateFormWithClasses(classes)){
            return false;
        }
        let name = $('.comment_name').val();
        let email = $('.comment_email').val();
        let content = $('.comment_content').val();
        if(!isEmail(email)){
            toastr.error("Enter a valid email");
            return false;
        }
        buttonClassClicked('submit_comment','SUBMIT COMMENT',1);
        axios.post(baseUrl+'/submit-comment',{
            name : name,
            email : email,
            comment_content : content
        })
            .then(function(response){
                if(response.data == 0){
                    toastr.error('Sorry, unable to send comment. Try again later');
                }else if(response.data == 1){
                    toastr.success('Received, Thanks for your feedback');
                    $('.comment_name').val("");
                    $('.comment_email').val("");
                    $('.comment_content').val("");
                }else{
                    toastr.info('Unable to send comment. Try again later');
                }
                buttonClassClicked('submit_comment','SUBMIT COMMENT',0);
            })
            .catch(function(error){
                extractError(error);
                buttonClassClicked('submit_comment','SUBMIT COMMENT',0);
            })



    });
});