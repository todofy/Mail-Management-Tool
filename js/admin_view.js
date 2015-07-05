$(document).ready(function() {

    $(".button-delete").on('click', function(e) {
    	if (!prompt("Are you sure you want to delete this Admin?")) return;
        //get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        request = new AJAX ('delete_admin', 
            {admin_id : id},
            function(d) {
                successAlert('Admin deleted successfully');
                _this.parent('td').parent('tr').remove();
            }, function(d){
                errorAlert('Unable to delete admin.');
            });
        e.preventDefault();
    });


  $(".button-revoke").on('click', function(e){
  	if (!prompt("Are you sure you want to revoke key for this Admin?")) return;
	//get id of button clicked
        var id = $(this).attr('id');

        //console.log(id);
    	request = new AJAX ('revoke_admin', {admin_id : id} , function(d){
    		successAlert('Admin API Key revoked! New API Secret key is ' +d.data +'<br>A mail has been sent to admin with new API key!');
    	}, function(d){
    		errorAlert('Unable to revoke Secret API key for this admin!');
    	});	
	});
});
