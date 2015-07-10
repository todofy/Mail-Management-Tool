$(document).ready(function() {

    $(".button-delete").on('click', function(e) {
    	//get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        $(".button-delete-confirm").on('click',function(e){
            request = new AJAX ('delete_admin', 
                {admin_id : id},
                function(d) {
                    successAlert('Admin deleted successfully.');
                    _this.parent('td').parent('tr').remove();
                }, function(d){
                    errorAlert('Unable to delete admin.');
                });
            e.preventDefault();
        });
        e.preventDefault();
    });


    $(".button-revoke").on('click', function(e){
        //get id of button clicked
        var id = $(this).attr('id');       
        $(".button-revoke-confirm").on('click',function(){
    	   request = new AJAX ('revoke_admin', {admin_id : id} ,
                function(d){
                successAlert('Admin API Key revoked! New API Secret key is ' +d.data +'<br>A mail has been sent to admin with new API key!');
                }, function(d){
                    errorAlert('Unable to revoke Secret API key for this admin!');
            });
        });
        e.preventDefault();	
	});
});
