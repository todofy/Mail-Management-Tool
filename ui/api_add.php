<?php
if (!isset($_API_ADD_)) {
    throw new Exception("Code file not included for api_add.php!");
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
				    <li><a href="api.php">API</a></li>
				    <li class="active">Add</li>
				</ol>
			</div>
		<?php
		if(empty($templates)){
				echo '
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
						<div class="alert alert-info" style="text-align: center;">No templates available.<a href="template_add.php"> Create a new template.</a></div>
					</div>';
		}
		else{
			echo '
			<div class="col-xs-12">
				<h3>Create API</h3>
				<form role="form" type="post" id="create-api">
					<div class="form-group">
	    				<label for="template-name"><h4>API Name</h4></label>
	    				<input type="text" class="form-control" id="api-name" name="api-name" style="width: 40%; min-width: 200px">
	  				</div>
	  				<div class="form-group">
	  					<label class="control-label"><h4>Select Template</h4></label>
	  					<select class="form-control" name="template" style="width:auto; display:inline-block; margin-left: 10px;">';
	    						foreach ($templates as $value) {
	    							echo '<option>'.$value['name'].'</option>';
	    						}
	    				echo '
	  					</select>
	  					<a href="template_add.php" type="button" class="btn btn-link">Create a new Template</a>
					</div>
				</form>
	  			<button type="submit" class="btn btn-success" value="Submit" id="save">Save</button>
	  			<a href="api.php" class="btn btn-link" id="cancel">Cancel</a>
			</div>
		</div>
		<div class="col-xs-12">
			<div id="api-details" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="z-index: 15000; margin-top:40px;">
	  			<div class="modal-dialog" style="margin:auto; width: 90%; overflow-y: initial;">
	    			<div class="modal-content">
	    				<div class="modal-header">
	    					<a href="api.php" class="close">&times;</a>
	        				<center><h4 class="modal-title">API has been created successfully</h4></center>
	      				</div>
	      				<div class="modal-body">
	      					<div class="row">
	      						<div class="col-xs-4">
	      							<h5>Here\'s how you\'d call the API</h5>
	      							<div class="well" id="api-call" style="word-wrap: break-word;"></div>
	      							<h5>PHP Example:</h5>
	      							<div class="well" id="php-example" style="word-wrap: break-word;"></div>
	      						</div>
	      						<div class="col-xs-8">
	      							<h5>Response to API call</h5>
	      							<div class="well" id="api-response"></div>
	      						</div>
	      					</div>
	      					<a href="api.php" class="btn btn-success">Done</a>
	      				</div>
	    			</div>
	  			</div>
			</div>';
		}
		?>
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
<script src="js/api_add.js"></script>
</body>
</html>