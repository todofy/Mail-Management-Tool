<?php
if (!isset($_ADMIN_EDIT_)) {
    throw new Exception("Code file not included for admin_edit.php!");
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
    			    <li><a href="./admin_view.php">View Admins</a></li>
    			    <li class="active">Edit Admin</li>
    			</ol>
        </div>
  			<div class="col-xs-12">
  				<h3>Edit an admin</h3>
  				<form role="form" id="edit" type="post">
  					<div class="form-group">
      					<label for="email"><h4>Email address:</h4></label>
      					<input type="email" class="form-control" name="email" id="email" style="width: 35%; min-width: 200px" value=<?php echo $email ?> >
      					<!-- TODO: Populate this input with the current user's email id  -->
    					</div>				
    					<h4 class="control-label">Access rights:</h4>
    					<div class="form-group">
    						<?php
    							foreach ($accesses as $value) {
    								echo '<div>';
    								$bHasAccess = false;
    								foreach ($accessForThisAdmin as  $a) {
    									if ($value['id'] == $a['access_id']) {
    										$bHasAccess = true;
    										break;
    									}
    								}

    								echo '<input type="checkbox" name="access[]" value="' .$value['id'] .'" ';
    								if ($bHasAccess) echo ' checked="true" ';
    								echo '>';
    								echo ' <strong style="text-transform: uppercase">' .$value['name'] .'</strong>: &nbsp; ' .$value['description'];
    								echo '</div>';
    							}
    						?>
    					</div>

    					<div class="clearfix"></div>
    					
    					<button type="submit" class="btn btn-primary" value="Submit" id="btn">Edit</button>
  				</form>					
  			</div>
  			<div class="col-xs-4 pull-right">
  				
  			</div>
  		</div>		
  	</div>
<div class="col-xs-12"  id="wait-message" style="height:100%; position:fixed; left:0px; top:0px; background-color:rgba(0,0,0,0.3); z-index:100; display:none;">
  <div class="col-xs-6 col-xs-offset-3 col-sm-12 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4" style="position: fixed; top:25%;">
      <div class="alert alert-info" style="padding: 15px;">
        <h4 style="margin-bottom:0px;"><center>Processing...</center></h4>
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
<script src="js/admin_edit.js"></script>
</body>
</html>