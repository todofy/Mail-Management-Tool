$(document).ready(function() {
  	$("#btn").click(function(e){
	 		  var jsonData = {};
	 		  var formData = $("#edit").serializeArray();
  			//console.log(formData);
   
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
   			console.log(jsonData);
		    $request = new AJAX ('edit_admin', jsonData, function(d){alert('Success.')}, function(d){alert('Failure.')});
        e.preventDefault();	
		});
});
