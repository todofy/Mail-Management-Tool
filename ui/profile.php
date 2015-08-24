<?php
if (!isset($_CODE_PROFILE_)) {
    throw new Exception("Code file not included for profile.php!");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div class="row" id="container">
		<?php
		include __DIR__ .'/header.php';
		include __DIR__ .'/sidebar.php';
		?>

		<!-- Main workspace starts from here -->
		<div id="content-wrapper" class="col-xs-10 col-xs-offset-2">
			<div class="col-xs-12">
				<ol class="breadcrumb">
				    <li><a href="dashboard.php">Home</a></li>
				    <li class="active">Profile</li>
				</ol>
			</div>
			<div class="col-xs-12">
				<h3>Profile</h3>
				<?php
				    echo '<h4>Email : '.$email.'</h4>';
				?>
				<a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#change-password"><span class="glyphicon glyphicon-pencil" style="margin-right:5px;"></span>Change Password</a>
				<br>
				<h4>Access rights:</h4>
				<ul style="list-style: none; padding-left:10px;">
				<?php
					foreach ($accesses as $value1) {
						$flag = 0;
						foreach($adminAccess as $value2){
							if($value1 == $value2){
								echo '<li style="text-transform: uppercase;"><span class="glyphicon glyphicon-check" style="margin-right:5px;"></span>'. $value1['name'] .'</li>';
								$flag = 1;
							}
						}
						if($flag == 0)
							echo '<li style="text-transform: uppercase;"><span class="glyphicon glyphicon-unchecked" style="margin-right:5px;"></span>'. $value1['name'] .'</li>';
					}
				?>
				</ul>
				<br>
				<a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-ban-circle" style="margin-right:5px;"></span>Delete Account</a>
			</div>
			<div class="col-xs-12">
				<div id="change-password" class="modal fade" role="dialog" style="z-index: 15000; margin-top:40px;">
		  			<div class="modal-dialog">
		    			<div class="modal-content">
		  					<div class="modal-header">
		       					<h3>Change password</h3>
		      				</div>
		    				<div class="modal-body">
		        				<form class="form-horizontal" role="form" id="change_pw" type="post">
		  							<div class="form-group">
		    							<label class="control-label col-xs-4" for="current"><h4>Current password:</h4></label>
		    							<div class="col-xs-8">
		    								<input type="password" class="form-control" id="current_pw" name="current_pw" placeholder="Enter current password">
		    							</div>
		    						</div>
		    						<div class="form-group">
			    						<label class="control-label col-xs-4" for="new"><h4>New password:</h4></label>
			    						<div class="col-xs-8">
		    								<input type="password" class="form-control" id="new_pw" name="new_pw" placeholder="Enter new password">
		    							</div>
		  							</div>
		  							<div class="form-group">
		    							<label class="control-label col-xs-4" for="confirm"><h4>Confirm password:</h4></label>
		    							<div class="col-xs-8">
		    								<input type="password" class="form-control" id="confirm_pw" name="confirm_pw" placeholder="Confirm new password">
		    							</div>
		  							</div>
		  							<button type="submit" class="btn btn-primary" value="Submit" data-dismiss="modal" id="btn">Done</button>
		  							<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
		 						</form>
		  					</div> 					
		        		</div>
		    		</div>
		  		</div>
		  	</div>
		  	<div class="col-xs-12">
		  		<div id="confirm-delete" class="modal fade" role="dialog" style="z-index: 15000; margin-top:40px;">
		  			<div class="modal-dialog">
		    			<div class="modal-content">
		  					<div class="modal-header">
		       					<h3>Delete Account</h3>
		      				</div>
		    				<div class="modal-body">
		        				<form class="form-inline" role="form" id="delete_acc" type="post">
		  							<div class="form-group">
		    							<label for="pwd"><h4>Enter password:</h4></label>
		    							<input type="password" class="form-control" id="pwd" name="pwd" style="width: 50%; min-width: 200px">
		    						</div>
		 						</form>
		 						<br>
		 						<button type="submit" class="btn btn-danger delete-account" data-dismiss="modal" value="Submit">Confirm</button>
		  						<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
		  					</div> 					
		        		</div>
		    		</div>
		  		</div>	
		  	</div>	
		</div>
	</div>
	<div class="row"  id="warning-message">
		<div class="col-xs-12">
			<div class="well">
				<h2>Please switch to landscape mode.</h2>
			</div>
		</div>
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/profile.js"></script>
</body>
</html>