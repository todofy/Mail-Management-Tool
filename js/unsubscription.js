$(document).ready(function() {
  	$("#unsub").click(function(e){
  	 		  var jsonData = {};
  	 		  var formData = $("#unsubscribe").serializeArray();
     
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

          $('#wait-message').show();
  		    request = new AJAX ('unsubscribe', jsonData, function(d){
              $('#wait-message').hide();
              $('#content-wrapper').hide();
              $('#success-message').show();              
              }, function(d){
              $('#wait-message').hide();
              errorAlert(d.message);
              });
          e.preventDefault();	
		});
});
