$(document).ready(function() {
  	$("#btn").click(function(e){
        if(validate_form())
        {
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
  		    request = new AJAX ('add_admin', jsonData, function(d){
              successAlert('Admin added successfully.');
              $(".closejAlert.ja_close").click(function(e){
                  window.location="admin_view.php";
                  e.preventDefault();
                });
              }, function(d){
              errorAlert('Unable to add admin.');
              });
          e.preventDefault();	
        }
        else
        {
          return false;
        }
		});
});
