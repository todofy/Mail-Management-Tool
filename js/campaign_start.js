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
        jsonData = JSON.stringify(formData, null, '\t');
        console.log(formData);
 		console.log(jsonData);
	});
});
