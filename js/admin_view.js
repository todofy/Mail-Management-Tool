$(document).ready(function() {
  	$(".btn.btn-danger").click(function(e){
	    //get id of button clicked
        var id = this.id;
        //console.log(id);
        $("#delete_admin").click(function(e){
        	request = new AJAX ('delete_admin', {admin_id : id} , function(d){
        		successAlert('Admin deleted.');
        		$(".closejAlert.ja_close").click(function(e){
        			window.location="admin_view.php";
        			e.preventDefault();
        		});
        	}, function(d){
        		errorAlert('Unable to delete admin.');
        	});
        	e.preventDefault();	
        });
        e.preventDefault();	
		});
  	$(".btn.btn-warning").click(function(e){
	    //get id of button clicked
        var id = this.id;
        //console.log(id);
        $("#revoke_admin").click(function(e){
        	request = new AJAX ('revoke_admin', {admin_id : id} , function(d){
        		successAlert('Secret key of admin revoked.');
        		$(".closejAlert.ja_close").click(function(e){
        			window.location="admin_view.php";
        			e.preventDefault();
        		});
        	}, function(d){
        		errorAlert('Unable to revoke secret key.');
        	});
        	e.preventDefault();	
        });
        e.preventDefault();	
		});
});
