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
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
			    <li><a href="./dashboard.php">Home</a></li>
			    <li class="active">View Admins</li>
			</ol>
			<div class="col-md-12">
				<h3>List of all admins</h3>
				<div class="clearfix"></div>
				<table class="table">
					<tr>
						<th>#ID</th>
						<th>Email</th>
						<th>Last Login</th>
						<th>Actions</th>
					</tr>
					<?php
						foreach ($admins as $value) {
							echo '<tr>';
							echo '<td>' .$value['id'] .'</td>';
							echo '<td>' .$value['email'] .'</td>';
							echo '<td>' .date("D, d M 20y", $value['last_login']) .'</td>';
							echo '<td>';
							if (isset($newuser->access[EDIT_ADMIN])) {
								echo '<a class="btn btn-primary" href="admin_edit.php" role="button" id='.$value['id'].'>Edit</a> ';
							}
							if (isset($newuser->access[REVOKE_ADMIN])) {
								echo '<a class="btn btn-warning" href="#" role="button" data-toggle="modal" data-target="#revoke" id='.$value['id'].'>Revoke key</a> ';
							}
							if (isset($newuser->access[DELETE_ADMIN])) {
								echo '<a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#delete" id='.$value['id'].'>Delete</a> ';
							}
							echo '</td>';
							echo '</tr>';
						}
					?>
				</table>					
			</div>
			<div class="col-md-4 pull-right">
				
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
        				<button type="button" class="btn btn-warning" data-dismiss="modal">Revoke key</button>
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
        				<button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
        				<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        			</div>
    			</div>
  			</div>
		</div>		
	</div>
<script src="js/admin_view.js"></script>
</body>
</html>