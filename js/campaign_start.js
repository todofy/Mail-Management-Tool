$(document).ready(function(){ 
	$("#start").click(function(e){
 		var jsonData = {};
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
 		//console.log(jsonData);
	});
});
