$(document).ready(function() {
  	$("#create").click(function(e){
  	 		  var jsonData = {};
          //get html content from editor
          var text = tinyMCE.activeEditor.getContent();
          $("#template-text").val(text);
  	 		  var formData = $("#create-template").serializeArray();
     
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
          request = new AJAX ('add_template', jsonData, function(d){
              successAlert(d.message);
              $(".closejAlert.ja_close").click(function(e){
                  window.location="template.php";
                  e.preventDefault();
                });
              }, function(d){
              errorAlert(d.message);
              }); 
          e.preventDefault(); 		    
  	  });
});
