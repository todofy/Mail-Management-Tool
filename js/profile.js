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
     			//console.log(jsonData);
          $('#wait-message').show();
  		    request = new AJAX ('change_pw', jsonData, function(d){
              $('#wait-message').hide();
              successAlert(d.message);
              $(".closejAlert.ja_close").click(function(e){
                  window.location="dashboard.php";
                  e.preventDefault();
                });
              }, function(d){
              $('#wait-message').hide();
              errorAlert(d.message);
              });
          e.preventDefault();	
        }
        else
        {
          return false;
        }
		});
    $(".delete-account").click(function(e){
        var pwd = $('#pwd').val();
        if(pwd != ''){
          var jsonData = {};
          var formData = $("#delete_acc").serializeArray();
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
        $('#wait-message').show();
      request = new AJAX ('delete_account', jsonData, function(d){
        $('#wait-message').hide();
        successAlert(d.message);
        $(".closejAlert.ja_close").click(function(e){
            window.location="logout.php";
            e.preventDefault();
            });
      },function(d){
        $('#wait-message').hide();
        errorAlert(d.message);
      });
      e.preventDefault();
    }else{
      alert("Enter you password to confirm");
    }
    });
});
