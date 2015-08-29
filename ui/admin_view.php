<?php
if (!isset($_ADMIN_VIEW_)) {
    throw new Exception("Code file not included for admin_view.php!");
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
					    <li class="active">View Admins</li>
					</ol>
				</div>
		    	<div class="col-xs-9">
		    		<h3>List of all Admins</h3>
		    	</div>
		    	<div class="col-xs-3">
		    	<?php
		    		if (isset($newuser->access[ADD_ADMIN])){
						echo '<a href="admin_add.php" type="button" class="btn btn-success" style="float:right; margin-right: 5px;">Add</a>';
					}
				?>
				</div>
				<div class="col-xs-12">
					<table class="table">
						<tr style="background-color: #E0E0E0;">
							<th class="col-xs-1"><center>#ID</center></th>
							<th class="col-xs-4">Email</th>
							<th class="col-xs-2"><center>Campaigns Started</center></th>
							<th class="col-xs-2"><center>Last Login</center></th>
							<th class="col-xs-3" style="text-align:right;">Actions</th>
						</tr>
						<?php
							foreach ($admins as $value) {
								echo '<tr>';
								echo '<td><center>' .$value['id'] .'</center></td>';
								echo '<td>' .$value['email'] .'</td>';
								echo '<td><center>'.$value['campaigns'].'</center></td>';
								if($value['last_login'] != null)
									echo '<td><center>' .date("D, d M 20y", $value['last_login']).'<br>'.date("h:i:s A (e)", $value['last_login']).'</center></td>';
								else
									echo '<td><center> --- <center></td>';
								echo '<td style="text-align:right;">';
								if (isset($newuser->access[EDIT_ADMIN]) && $value['id']!=$id) {
									$add = "admin_edit.php?id=".$value['id'];
									echo '<a class="btn btn-primary button-edit" href='.$add.' role="button" id='.$value['id'].'>Edit</a> ';
								}
								else echo '<a class="btn btn-primary disabled button-edit" href="javascript:void(0)" role="button">Edit</a> ';
								if (isset($newuser->access[REVOKE_ADMIN]) && $value['id']!=$id) {
									echo '<a class="btn btn-warning button-revoke" href="#" role="button" data-toggle="modal" data-target="#revoke" id='.$value['id'].'>Revoke key</a> ';
								}
								else echo '<a class="btn btn-warning disabled button-edit" href="javascript:void(0)" role="button">Revoke key</a> ';
								if (isset($newuser->access[DELETE_ADMIN]) && $value['id']!=$id) {
									echo '<a class="btn btn-danger button-delete" href="#" role="button" data-toggle="modal" data-target="#delete" id='.$value['id'].'>Delete</a> ';
								}
								else echo '<a class="btn btn-danger disabled button-edit" href="javascript:void(0)" role="button">Delete</a> ';
								echo '</td>';
								echo '</tr>';
							}
						?>
					</table>					
				</div>
			</div>
			<div class="col-xs-12">
				<div id="revoke" class="modal fade" role="dialog" style="z-index: 15000; top:20%; left:10%;">
		  			<div class="modal-dialog">
		    			<div class="modal-content">
		    				<div class="modal-header">
		        				<h4 class="modal-title">Revoke Secret Key</h4>
		      				</div>
		      				<div class="modal-body">
		        				<p>Are you sure you want to revoke the secret key for this admin?</p>
		        				<br>
		        				<button type="button" class="btn btn-warning button-revoke-confirm" data-dismiss="modal">Revoke key</button>
		        				<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
		        			</div>
		    			</div>
		  			</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div id="delete" class="modal fade" role="dialog" style="z-index: 15000; top:20%; left:10%;">
		  			<div class="modal-dialog">
		    			<div class="modal-content">
		    				<div class="modal-header">
		        				<h4 class="modal-title">Delete Admin</h4>
		      				</div>
		      				<div class="modal-body">
		        				<p>Are you sure you want to delete this admin?</p>
		        				<br>
		        				<button type="button" class="btn btn-danger button-delete-confirm" data-dismiss="modal">Delete</button>
		        				<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
		        			</div>
		    			</div>
		  			</div>
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
<script src="js/admin_view.js"></script>
</body>
</html>