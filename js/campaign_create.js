$(document).ready(function() {
  	$("#create").click(function(e){
      if(validate_fields())
      {
       var jsonData = {};
  	 		  var formData = $("#add").serializeArray();
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
          /*
  		    request = new AJAX ('add_admin', jsonData, function(d){
              successAlert(d.message);
              $(".closejAlert.ja_close").click(function(e){
                  window.location="admin_view.php";
                  e.preventDefault();
                });
              }, function(d){
              errorAlert(d.message);
              });
          e.preventDefault();
          */	
       }
       else
       return false; 
		});
});

function validate_fields()
{
  var err = "";
  $("#params").each(function()
  {
    if($(this).val()=="")
      err = "Parameters field empty";
  });
  if(err!="")
  {
    alert(err);
    return false;
  }
  $("#to").each(function()
  {
    //validate the email
    var email= $(this).val();
    var pattern  = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    if (email == '') {
          err = 'To feild missing';
      }
    else if(!pattern.test(email))
    {
      err = 'Please enter a valid email adddress';
    }

  });
  if(err!=""){
    alert(err);
    return false;
  }
  return true;

}