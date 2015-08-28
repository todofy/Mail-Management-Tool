$(document).ready(function(){ 
	$("#start").click(function(e){
 		var jsonData = {};
        formData = form2js('start_campaign', '.', true,
                function(node)
                {
                    if (node.id && node.id.match(/callbackTest/))
                    {
                        return { name: node.id, value: node.innerHTML };
                    }
                });
        jsonData = JSON.stringify({data: formData}, null, '\t');

        request = new AJAX ('campaign_start', jsonData, function(d){
                successAlert(d.message);
                $(".closejAlert.ja_close").click(function(e){
                    window.location="dashboard.php";
                    e.preventDefault();
                });
                }, function(d){
                    errorAlert(d.message);
                    $(".closejAlert.ja_close").click(function(e){
                        window.location="campaign_create.php";
                        e.preventDefault();
                    });
                });
	});
});
