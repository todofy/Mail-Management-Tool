$(document).ready(function() {
  	$("#reset").click(function(e){
        if(validate())
        {
  	 		  var jsonData = {};
  	 		  var formData = $("#forgot_pw").serializeArray();
     
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
  		    request = new AJAX ('forgot_pw', jsonData, function(d){
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

function validate()
{
  //get the email to be verified
  var email = $('#regis_email');
  if($.trim(email.val())=="")
  {
    email.css('backgroung_color' , 'red');
    return false;
  }
  else
  {
    //check if a valid email
    var pattern  = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/; 
    if(!pattern.test(email.val()))
    {
      email.css('backgroung_color' , 'red');
      return false;
    }
    else
    {
      email.css('backgroung_color' , 'green');
      return true;
    }
  }
}
