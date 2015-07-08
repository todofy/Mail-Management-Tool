$(document).ready(function() {
    $(".button-delete").on('click', function(e) {
    	//get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        $(".button-delete-confirm").on('click',function(e){
            request = new AJAX ('delete_template', 
                {template_id : id},
                function(d) {
                    successAlert(d.message);
                    _this.parent('td').parent('tr').remove();
                }, function(d){
                    errorAlert(d.message);
                });
            e.preventDefault();
        });
        e.preventDefault();
    });
});
