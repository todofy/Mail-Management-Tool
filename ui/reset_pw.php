<?php
if (!isset($_RESET_PW_)) {
    throw new Exception("Code file not included for reset_pw.php!");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Todofy</title>
    <link rel="icon" href="assets/icon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-2.0.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/jAlert-v3.css" />
	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link rel="stylesheet" href="css/content.css" type="text/css">
	<link rel="stylesheet" href="css/custom.css" type="text/css">
</head>

<body>
	<div class="row">

		<div  id="header" class="col-xs-12 header-user-dropdown">
			<div class="row header-limiter">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
				<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2" id="logo-container">
					<img id="logo" src="assets/logo.png">
				</div>
				<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9"></div>
			</div>
		</div>
		<?php
            if($success)
            {
                echo '
				<div id="content-wrapper" class="col-xs-12">
					<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
						<h2>Reset Password</h2>
						<form class="form-inline" role="form" type="post" id="reset_pw">
						<input type="text" id = "token" class="form-control" name="token"'.'value="'.$hash.'"'.'style="display: none;">
							<div class="form-group col-xs-12">
			    				<label class="col-sm-3" for="new_pw" style="padding-top:0px; padding-left:0px;"\><h4>New Password:</h4></label>              
		          				<input type="password" class="form-control" id="new_pw" name="new_pw" style="width:100%; max-width:450px;">
							</div>
							<div class="form-group col-xs-12">
			    				<label class="col-sm-3" for="confirm_pw" style="padding-top:0px; padding-left:0px;"\><h4>Confirm Password:</h4></label>              
		          				<input type="password" class="form-control" id="confirm_pw" name="confirm_pw" style="width:100%; max-width:450px;">
							</div>
						</form>
						<br>
			  			<button type="submit" class="btn btn-primary" value="Submit" id="reset">Reset</button>
					</div>
				</div>
			</div> ';
			}
		else
		{
			echo '
			<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" style="margin-top: 7.5%;">
				<form method = "POST" id = "email_form" > 
				<input type = "text" name = "email" value = "'.$email.'" style = "display:none;">
				</form>
				<div class="alert alert-danger" style="text-align: center;">Password reset token has expired. <a href="#" id="resend">Resend password reset link</a></div>
			</div>';
		}
	?>
	<div class="col-xs-12"  id="wait-message" style="height:100%; position:fixed; left:0px; top:0px; background-color:rgba(0,0,0,0.3); z-index:100; display:none;">
		<div class="col-xs-6 col-xs-offset-3 col-sm-12 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4" style="position: fixed; top:25%;">
		    <div class="alert alert-info" style="padding: 15px;">
		    	<h4 style="margin-bottom:0px;"><center>Processing...</center></h4>
		    </div>
	    </div>
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/reset_pw.js"></script>
</body>
</html>