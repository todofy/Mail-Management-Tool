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

	<?php
	include __DIR__ .'/header.php';
	include __DIR__ .'/sidebar.php';
	?>

	<!-- Main workspace starts from here -->
	<div id="content-wrapper">
		<div class="row">
			<ol class="breadcrumb">
			    <li><a href="dashboard.php">Home</a></li>
			    <li class="active">View Admins</li>
			</ol>
			<div class="row">
		    	<div class="col-md-9">
		    		<h3>List of all Admins</h3>
		    	</div>
		    	<div class="col-md-3">
		    	<?php
		    		if (isset($newuser->access[ADD_ADMIN])){
						echo '<a href="admin_add.php" type="button" class="btn btn-success pull-right">Add</a>';
					}
				?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12">
				<table class="table">
					<tr>
						<th class="col-md-1">#ID</th>
						<th class="col-md-5">Email</th>
						<th class="col-md-3">Last Login</th>
						<th class="col-md-3">Actions</th>
					</tr>
					<?php
						foreach ($admins as $value) {
							echo '<tr>';
							echo '<td>' .$value['id'] .'</td>';
							echo '<td>' .$value['email'] .'</td>';
							if($value['last_login'] != null)
								echo '<td>' .date("D, d M 20y", $value['last_login']) .'</td>';
							else
								echo '<td> -NA- </td>';
							echo '<td>';
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
		<div id="revoke" class="modal fade" role="dialog" style="z-index: 15000; margin-top:100px;">
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
		<div id="delete" class="modal fade" role="dialog" style="z-index: 15000; margin-top:100px;">
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
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/admin_view.js"></script>
</body>
</html>