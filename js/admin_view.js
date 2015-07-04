$(document).ready(function() {

    $(".button-delete").on('click', function(e) {
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
	    //get id of button clicked
        var id = $(this).attr('id');

        //console.log(id);
    	request = new AJAX ('revoke_admin', {admin_id : id} , function(d){
    		successAlert('Admin API Key revoked');
    		$(".closejAlert.ja_close").click(function(e){
    			window.location="admin_view.php";
    			e.preventDefault();
    		});
    	}, function(d){
    		errorAlert('Unable to revoke secret key.');
    	});	
	});

});
