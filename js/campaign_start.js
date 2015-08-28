$(document).ready(function(){ 
	$("#start").click(function(e){
 		var jsonData = {};
        /*
 		var formData = $("#start_campaign").serializeArray();
		console.log(formData);
 
		$.each(formData, function() {
	  		if (jsonData[this.name]) {
     			if (!jsonData[this.name].push) {
         			jsonData[this.name] = [jsonData[this.name]];
     			}
     			jsonData[this.name].push(this.value || '');
 			} else {
     			jsonData[this.name] = this.value || '';
 			}

    	});
        */
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
