$(document).ready(function() {
  	$("#save").click(function(e){
  	 		  var jsonData = {};
  	 		  var formData = $("#edit-api").serializeArray();
     
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
          request = new AJAX ('edit_api', jsonData, function(d){
              $("#api-details").modal('show');
              $("#api-call").html(d.data[0]);
              $("#api-response").html(d.data[1]);
              $("#php-example").html(d.data[2]);
              }, function(d){
              errorAlert(d.message);
              }); 
          e.preventDefault(); 		    
  	  });
});