$(document).ready(function() {

    $(".button-delete-admin").on('click', function(e) {
    	//get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        $(".button-delete-confirm-admin").on('click',function(e){
            request = new AJAX ('delete_admin', 
                {admin_id : id},
                function(d) {
                    successAlert('Admin deleted successfully.');
                    _this.parent('td').parent('tr').remove();
                    if($('#admin >tbody >tr').length == 1){
                        $('#admin').remove();
                        $('#admin-head').remove();
                    }
                }, function(d){
                    errorAlert('Unable to delete admin.');
                });

            $(this).unbind("click");
            e.preventDefault();
        });
        e.preventDefault();
    });


    $(".button-revoke-admin").on('click', function(e){
        //get id of button clicked
        var id = $(this).attr('id');       
        $(".button-revoke-confirm-admin").on('click',function(){
    	   request = new AJAX ('revoke_admin', {admin_id : id} ,
                function(d){
                successAlert('Admin API Key revoked! New API Secret key is ' +d.data +'<br>A mail has been sent to admin with new API key!');
                }, function(d){
                    errorAlert('Unable to revoke Secret API key for this admin!');
            });
            $(this).unbind("click");
        });
        e.preventDefault();	
	});

    $(".button-delete-api").on('click', function(e) {
        //get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        $(".button-delete-confirm-api").on('click',function(e){
            request = new AJAX ('delete_api', 
                {api_id : id},
                function(d) {
                    successAlert(d.message);
                    _this.parent('td').parent('tr').remove();
                    if($('#api >tbody >tr').length == 1){
                        $('#api').remove();
                        $('#api-head').remove();
                    }
                }, function(d){
                    errorAlert(d.message);
                });
            $(this).unbind("click");
            e.preventDefault();
        });
        e.preventDefault();
    });

    $(".button-view-template").on('click', function(e) {
        //get id of button clicked
        var id = $(this).attr('id');
        request = new AJAX ('view_template', 
            {template_id : id},
            function(d) {
                $("#template-preview").html(d.data);
                $(".button-edit-secondary").attr("href", "template_edit.php?id="+id);
            }, function(d){
                $("#template-preview").html(d.data);
        });
        e.preventDefault();

    });
    $(".button-delete-template").on('click', function(e) {
        //get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        $(".button-delete-confirm-template").on('click',function(e){
            request = new AJAX ('delete_template', 
                {template_id : id},
                function(d) {
                    successAlert(d.message);
                    _this.parent('td').parent('tr').remove();
                    if($('#template >tbody >tr').length == 1){
                        $('#template').remove();
                        $('#template-head').remove();
                    }
                }, function(d){
                    errorAlert(d.message);
                });
            $(this).unbind("click");
            e.preventDefault();
        });
        e.preventDefault();
    });
});
