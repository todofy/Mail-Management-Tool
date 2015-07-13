$(document).ready(function() {
  	$("#save").click(function(e){
  	 		  var jsonData = {};
  	 		  var formData = $("#create-api").serializeArray();
          
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
          request = new AJAX ('add_api', jsonData, function(d){
              $("#api-details").modal('show');
              //successAlert(d.message);
              $(".closejAlert.ja_close").click(function(e){
                  window.location="api.php";
                  e.preventDefault();
                });
              }, function(d){
              errorAlert(d.message);
              }); 
          e.preventDefault(); 		    
  	  });
});