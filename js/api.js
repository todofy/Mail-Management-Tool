$(document).ready(function() { 
    $(".button-delete").on('click', function(e) {
    	//get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        $(".button-delete-confirm").on('click',function(e){
            $('#wait-message').show();
            request = new AJAX ('delete_api', 
                {api_id : id},
                function(d) {
                    $('#wait-message').hide();
                    successAlert(d.message);
                    _this.parent('td').parent('tr').remove();
                }, function(d){
                    $('#wait-message').hide();
                    errorAlert(d.message);
                });
            $(this).unbind("click");
            e.preventDefault();
        });
        e.preventDefault();
    });
});
