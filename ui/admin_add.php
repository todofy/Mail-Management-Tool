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

	<?php
	include __DIR__ .'/header.php';
	include __DIR__ .'/sidebar.php';
	?>

	<!-- Main workspace starts from here -->
	<div id="content-wrapper">
		<div class="row">
			<ol class="breadcrumb">
			    <li><a href="dashboard.php">Home</a></li>
			    <li class="active">Add Admin</li>
			</ol>
			<div class="col-md-7">
				<h3>Add an admin</h3>
				<form role="form" id="add" type="post">
  					<div class="form-group">
    					<label for="email"><h4>Email address:</h4></label>
    					<input type="email" class="form-control" id="email" name="email" placeholder="someone@dmain.com" style="width: 50%; min-width: 200px">
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
			<div class="col-md-4 pull-right">
				
			</div>
		</div>
		<div id="api-details" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="z-index: 15000; margin-top:40px;">
  			<div class="modal-dialog" style="width: 1100px; min-width:800px; margin-left: 140px;">
    			<div class="modal-content">
    				<div class="modal-header">
    					<a href="#" class="close" data-dismiss="modal">&times;</a>
        				<center><h4 class="modal-title">Admin added successfully</h4></center>
      				</div>
      				<div class="modal-body">
      					<div class="row">
      						<div class="col-md-12">
      							<h5>Response to API call</h5>
      							<div class="well" id="api-response"></div>
      						</div>
      					</div>
      					<a href="#" data-dismiss="modal" class="btn btn-success">Done</a>
      				</div>
    			</div>
  			</div>
		</div>
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/admin_add.js"></script>
</body>
</html>