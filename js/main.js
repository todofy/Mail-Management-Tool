/**
 * Js file to serve major codes, to be included everywhere
 */

var AJAX = function(category, data, successCallback, failureCallback) {
	this.data = data;
	this.category = category;
	this.successCallback = successCallback;
	this.failureCallback = failureCallback;

	this.trigger();
}

AJAX.prototype.trigger = function() {
	var XHR = new XMLHttpRequest();
	XHR.open('POST', 'ajaxserver/');
	XHR.setRequestHeader("Content-type","application/x-www-form-urlencoded");

	var _this = this;
	XHR.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			try {
				var obj = JSON.parse(this.response);
				if (obj.error) {
					if (typeof _this.failureCallback  == 'function') _this.failureCallback(obj);
				} else {
					if (typeof _this.successCallback  == 'function') _this.successCallback(obj);
				}
			} catch (ex) {
				alert(this.response);
				// TODO connect this to a notification later
				alert('Unable to parse response from server. Invalid Response From Server');
				if (typeof _this.failureCallback  == 'function') _this.failureCallback();
			}
		} else if (this.readyState == 4) {
			// TODO connect this to a notification later
			alert("Unable to connect to the internet");
		}
	}


	XHR.send('data=' +JSON.stringify({category: this.category, data: this.data}));
};

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

//function to validate the password form
function validate_form_pw()
{
	var current_pw = $('#current_pw').val();
	var new_pw = $('#new_pw').val();
	var confirm_pw = $('#confirm_pw').val();
	if(current_pw == ''){
		alert('Enter your current password.');
	}
	else if(new_pw == ''){
		alert('Enter a new password.');
	}
	else if(new_pw != confirm_pw){
		alert('Passwords don\'t match.');
	}
	else{
		return true;
	}
	return false;
}