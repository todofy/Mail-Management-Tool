<?php
    if (!isset($_CODE_INDEX_)) {
        throw new Exception("Code file not included for index.php!");
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
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="login" placeholder="Email" class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password" class="form-password form-control" id="form-password">
			                        </div>
                                    <?php
                                        if(isset($err)){
                                            echo '
                                            <label>
                                                <p style="font-weight: 100; color:#fff;">';
                                                    echo $err; 
                                            echo '</p>
                                            </label>';
                                        }
                                    ?>
                                    <div class="check-box">
                                        <label style="font-weight: 100; color: #fff;">
                                            <input type="checkbox" name="remember_me" id="remember_me" style="margin-right:5px;">Remember me on this device
                                        </label>
                                    </div>
			                        <button type="submit" class="btn" name="commit">Log in</button>
			                    </form>
		                    </div>
                            <div class="row description" style="color:#fff;">
                                <p>Forgot your password? <a href="index.php" style="color: rgb(222,152,151);">Click here to reset it</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </body>
</html>