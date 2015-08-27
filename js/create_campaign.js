$('#create_form').on('submit' , function()
{
	if(validate_form())
	return true;
	else
	return false;
});

function validate_form()
{
	//get the secret key
	var secretKey = $('#secret_key');
	//get the from field
	var from = $('#from');
	//get the no of mails
	var mails = $('#NO_mails');
	var success = true;
	//validate the secret key is not empty
	if($.trim(secretKey.val())=="" || secretKey.val().length!=32)
	{
		$('#secret-key-input').addClass("has-error");
		success = false;
	}
	else
	{
		$('#secret-key-input').removeClass("has-error");
	}
	if($.trim(from.val())!="")
	{
		//there is some input to the from feild so validate or the valid email
		var email= from.val();
	    var pattern  = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	    if(!pattern.test(email))
	    {
	      $('#from-input').addClass("has-error");
	      success = false;
	    }
	    else
	    {
	    	$('#from-input').removeClass("has-error");
	    }
	}
	if($.trim(mails.val())=="")
	{
		$('#mails-input').addClass("has-error");
	    success = false;
	}
	else
	{
		pattern = /^[0-9]*$/;
		if(!pattern.test(mails.val()))
		{
			$('#mails-input').addClass("has-error");
	      	success = false;
		}
		else
		{
			$('#mails-input').removeClass("has-error");
		}
	}
	return success;
}