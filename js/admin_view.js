$(document).ready(function() {
  	$(".btn-danger").click(function(e){
	    //get id of button clicked
        var id = this.id;
        console.log(id);
        //request = new AJAX ('delete_admin', {admin_id : id} , function(d){alert('Success.')}, function(d){alert('Failure.')});
        e.preventDefault();	
		});
});
