$(document).ready(function() {
  	$("#btn").click(function(e){
        if(validate_form())
        {
  	 		  var jsonData = {};
  	 		  var formData = $("#edit").serializeArray();
     
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
  		    request = new AJAX ('edit_admin', jsonData, function(d){
              $('#wait-message').hide();
              successAlert(d.message);
              $(".closejAlert.ja_close").click(function(e){
                window.location="admin_view.php";
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

//function to validate the add/edit form
function validate_form()
{
  var email= $('#email').val();
  var pattern  = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
  if (email == '') {
            alert('Please enter a email address');
        }
    else if(!pattern.test(email))
    {
      alert('Please enter a valid email adddress');
    }
    else if($('input[type=checkbox]:checked').length == 0)
    {
      alert('Select atleast one of the accessess');
    }
    else
    {
      return true;
    }
    return false;
}
