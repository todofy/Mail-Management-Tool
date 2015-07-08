$(document).ready(function() {
  	$("#create").click(function(e){
  	 		  var jsonData = {};
          var text = tinyMCE.activeEditor.getContent();
          console.log(text);
          $("#template-text").val() = text;
          console.log($("#template-text").val());
  	 		  var formData = $("#create-template").serializeArray();
     
     			/*$.each(formData, function() {
          		if (jsonData[this.name]) {
             			if (!jsonData[this.name].push) {
                 			jsonData[this.name] = [jsonData[this.name]];
             			}
             			jsonData[this.name].push(this.value || '');
         			} else {
             			jsonData[this.name] = this.value || '';
         			}
  	    	});*/
     			//console.log(jsonData); 
          e.preventDefault(); 		    
  	  });
});
