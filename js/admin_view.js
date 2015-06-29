$(document).ready(function() {
  	$(".btn.btn-danger").click(function(e){
	    //get id of button clicked
        var id = this.id;
        //console.log(id);
        $("#delete_admin").click(function(e){
        	request = new AJAX ('delete_admin', {admin_id : id} , function(d){
        		alert('Success.');
        		window.location="admin_view.php";
        	}, function(d){
        		alert('Failure.');
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
        		alert('Success.');
        		window.location="admin_view.php";
        	}, function(d){
        		alert('Failure.');
        	});
        	e.preventDefault();	
        });
        e.preventDefault();	
		});
});
