$(document).ready(function() {
  	$("#reset").click(function(e){
        if(validate_password())
        {
  	 		  var jsonData = {};
  	 		  var formData = $("#reset_pw").serializeArray();
    			console.log(formData);
     
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
          $('#wait-message').show();
  		    request = new AJAX ('reset_pw', jsonData, function(d){
              $('#wait-message').hide();
              successAlert(d.message);
              $(".closejAlert.ja_close").click(function(e){
                  window.location="index.php";
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
});

function validate_password()
{
  var success = true;
  //get the password and the confirm password field
  var password = $('#new_pw');
  var confirm_pass = $('#confirm_pw');
  console.log(password.val());
  if($.trim(password.val())=="" || $.trim(password.val()).length<6)
  {
    password.css('border-color' , 'red');
    success = false;
  }
  else
  {
    password.css('border-color' , 'green');
  }
  if($.trim(confirm_pass.val())=="")
  {
    confirm_pass.css('border-color' , 'red');
    success = false;
  }
  else
  {
    confirm_pass.css('border-color' , 'green');
  }
  if(success==false)
    return false;
  //check if they are equal or not
  if($.trim(password.val())!=$.trim(confirm_pass.val()))
  {
    confirm_pass.css('border-color' , 'red');
    return false;
  }
  else
    return true;
}
