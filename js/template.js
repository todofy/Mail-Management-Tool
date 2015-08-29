$(document).ready(function() {
    $(".button-view").on('click', function(e) {
        //get id of button clicked
        var id = $(this).attr('id');
        $('#wait-message').show();
        request = new AJAX ('view_template', 
            {template_id : id},
            function(d) {
                $('#wait-message').hide();
                $("#preview").modal('show');
                $("#template-preview").html(d.data);
                $(".button-edit-secondary").attr("href", "template_edit.php?id="+id);
            }, function(d){
                $('#wait-message').hide();
                $("#preview").modal('show');
                $("#template-preview").html(d.data);
        });
        e.preventDefault();

    });
    $(".button-delete").on('click', function(e) {
    	//get id of button clicked
        var id = $(this).attr('id');
        var _this = $(this);
        $(".button-delete-confirm").on('click',function(e){
            $('#wait-message').show();
            request = new AJAX ('delete_template', 
                {template_id : id},
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
