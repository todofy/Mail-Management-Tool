$(document).ready(function() {
  	$("#btn").click(function(e){
	 		  var jsonData = {};
	 		  var formData = $("#add").serializeArray();
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
   			//console.log(jsonData);
        var data = JSON.stringify(jsonData);
        console.log(data);
		    var request = new AJAX ('add_admin', data , function(d){alert('Success.')}, function(d){alert('Failed.')});
	      console.log(request);
        e.preventDefault();	
		});
});
