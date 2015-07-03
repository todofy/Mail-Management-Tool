$(document).ready(function() {
  	$("#btn").click(function(e){
        if(validate_form_pw())
        {
  	 		  var jsonData = {};
  	 		  var formData = $("#change_pw").serializeArray();
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
  		    request = new AJAX ('change_pw', jsonData, function(d){
              successAlert('Password changed.');
              }, function(d){
              errorAlert('Unable to change password.');
              });
          e.preventDefault();	
        }
        else
        {
          return false;
        }
		});
});
