$(document).ready(function(){ 
	$("#start").click(function(e){
        if(validate_form())
        {
     		var jsonData = {};
            formData = form2js('start_campaign', '.', true,
                    function(node)
                    {
                        if (node.id && node.id.match(/callbackTest/))
                        {
                            return { name: node.id, value: node.innerHTML };
                        }
                    });
            jsonData = JSON.stringify(formData, null, '\t');

            request = new AJAX ('campaign_start', jsonData, function(d){
                    successAlert(d.message);
                    $(".closejAlert.ja_close").click(function(e){
                        window.location="dashboard.php";
                        e.preventDefault();
                    });
                    }, function(d){
                        errorAlert(d.message);
                        $(".closejAlert.ja_close").click(function(e){
                            window.location="campaign_create.php";
                            e.preventDefault();
                        });
                    });
        }
	});
      
});

function validate_form()
{
    /*
        .addClass("has-error");
    */
    $('.form-control').each(function(){
        console.log($(this).val());
        var curId = $(this).attr('id');
        if($.trim($(this).val())=="")
        {
            console.log(curId);
            if(curId!="search_key")
            {
                $(this).css('border-color' , 'red');
                success = false;
            }
        }
        else
        {
            if(curId=="to")
            {
                //validate the email
                var email= $(this).val();
                var pattern  = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
                if(!pattern.test(email)){
                  $(this).css('border-color' , 'red');;
                  success = false;
                }
                else{
                    $(this).css('border-color' , 'green');
                }
            }
            else
            {
                $(this).css('border-color' , 'green');
            }
                
        }
    }); 
    return false;
}
