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
