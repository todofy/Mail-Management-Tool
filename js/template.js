$(document).ready(function() {
    $(".button-view").on('click', function(e) {
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
            $(this).unbind("click");
            e.preventDefault();
        });
        e.preventDefault();
    });
});
