<?php
    if (!isset($_FORGOT_PASSWORD_)) {
        throw new Exception("Code file not included for forgot_pw.php!");
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="assets/icon.png">
        <title>Todofy</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login.css">
        <script src="js/jquery-2.0.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                                <div class="col-md-8 col-md-offset-2">
                        	       <img src="assets/logo.png">
                                </div>
                            </div>
                            <div class="form-bottom">
			                    <?php
                                if($success)
                                {
                                    echo "A mail has been been sent to your email id. verication is required.";
                                }
                                else
                                {
                                    echo $err;
                                }
                                ?>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </body>
</html>