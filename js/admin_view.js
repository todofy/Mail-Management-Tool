$(document).ready(function() {

    $(".button-delete").on('click', function(e) {
    	//get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        $(".button-delete-confirm").on('click',function(e){
            $('#wait-message').show();
            request = new AJAX ('delete_admin', 
                {admin_id : id},
                function(d) {
                    $('#wait-message').hide();
                    successAlert('Admin deleted successfully.');
                    _this.parent('td').parent('tr').remove();
                }, function(d){
                    $('#wait-message').hide();
                    errorAlert('Unable to delete admin.');
                });

            $(this).unbind("click");
            e.preventDefault();
        });
        e.preventDefault();
    });


    $(".button-revoke").on('click', function(e){
        //get id of button clicked
        var id = $(this).attr('id');       
        $(".button-revoke-confirm").on('click',function(){
            $('#wait-message').show();
    	    request = new AJAX ('revoke_admin', {admin_id : id} ,
                function(d){
                $('#wait-message').hide();
                successAlert('Admin API Key revoked! New API Secret key is ' +d.data +'<br>A mail has been sent to admin with new API key!');
                }, function(d){
                    $('#wait-message').hide();
                    errorAlert('Unable to revoke Secret API key for this admin!');
            });
            $(this).unbind("click");
        });
        e.preventDefault();	
	});
});
