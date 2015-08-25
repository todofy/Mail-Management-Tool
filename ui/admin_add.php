<?php
if (!isset($_ADMIN_ADD_)) {
    throw new Exception("Code file not included for admin_add.php!");
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
    			    <li class="active">Add Admin</li>
    			</ol>
        </div>
  			<div class="col-xs-12">
  				<h3>Add an admin</h3>
  				<form role="form" id="add" type="post">
    					<div class="form-group">
      					<label for="email"><h4>Email address:</h4></label>
      					<input type="email" class="form-control" id="email" name="email" placeholder="someone@domain.com" style="width: 35%; min-width: 200px">
    					</div>
    					<h4 class="control-label">Access rights:</h4>
    					<div class="form-group">
    						<?php
    							foreach ($accesses as $value) {
    								echo '<div>';
    								echo '<input type="checkbox" name="access[]" value="' .$value['id'] .'">';
    								echo ' <strong style="text-transform: uppercase">' .$value['name'] .'</strong>: &nbsp; ' .$value['description'];
    								echo '</div>';
    							}
    						?>
    					</div>
    					<button type="submit" class="btn btn-success" value="Submit" id="btn">Add</button>

    					<div class="clearfix"></div>
    					<div class="bs-callout bs-callout-info">
    						<h4>Note</h4>
    						A password will be automatically generated for this admin and would be sent to the
    						email id. All other information like API key (if admin has access) and access would also be 
    						sent along with the mail.
    					</div>
    					
  				</form>					
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
<script src="js/admin_add.js"></script>
</body>
</html>