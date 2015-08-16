<?php
if (!isset($_SEARCH_VIEW_)) {
    throw new Exception("Code file not included for search.php!");
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
			    <li class="active">Search</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Search results for <?php echo "'" . $getKey . "'"; ?></h3>
			</div>
		</div>
		<?php
			if($total_results == 0) {
				echo '<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="alert alert-info" style="text-align: center;">No Search Results Found</div>
						</div>
					</div>';
			}
			if(!empty($search_admin)){
				echo '
					<div class="row">
					<div class="col-md-12">
						<h3>In Admins</h3>
						<table class="table">
							<tr style="background-color: #E0E0E0;">
								<th class="col-md-1"><center>#ID</center></th>
								<th class="col-md-4">Email</th>
								<th class="col-md-2"><center>Campaigns Started</center></th>
								<th class="col-md-2"><center>Last Login</center></th>
								<th class="col-md-3 pull-right">Actions</th>
							</tr>';
							foreach ($search_admin as $value) {
								echo '<tr>';
								echo '<td><center>' .$value['id'] .'</center></td>';
								echo '<td>' .$value['email'] .'</td>';
								echo '<td><center>'.$value['campaigns'].'</center></td>';
								if($value['last_login'] != null)
									echo '<td><center>' .date("D, d M 20y", $value['last_login']).'<br>'.date("h:i:s A", $value['last_login']).'</center></td>';
								else
									echo '<td><center> --- <center></td>';
								echo '<td class="pull-right">';
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
							
						echo '</table>
					</div>
				</div>';
			}
			if (!empty($search_campaign)) {
				echo '
					<div class="row">
					<div class="col-md-12">
						<h3>In Campaigns</h3>
						<table class="table">
							<tr style="background-color: #E0E0E0;">
								<th class="col-md-1"><center>#ID</center></th>
								<th class="col-md-3">Subject</th>
								<th class="col-md-1"><center>API Code</center></th>
								<th class="col-md-1"><center>Total mails</center></th>
								<th class="col-md-1"><center>Mails processed</center></th>
								<th class="col-md-1"><center>Link clicks</center></th>
								<th class="col-md-2"><center>Started On</center></th>
								<th class="col-md-2"><center>Finished On</center></th>
							</tr>';
							foreach ($search_campaign as $value) {
								echo '<tr class="campaign-row" data-href="campaign_view.php?id='.$value['id'].'" style="cursor:pointer;">';
								echo '<td><center>'.$value['id'].'<center></td>';
								echo '<td>' .$value['subject'] .'</td>';
								echo '<td><center>' .$value['api_code'] .'</center></td>';
								echo '<td><center>' .$value['payload_length'] .'</center></td>';
								echo '<td><center>' .$value['mails_processed'] .'</center></td>';
								echo '<td><center>' .$value['clicks'] .'</center></td>';
								echo '<td><center>' .date("D, d M 20y", $value['time_started']).'<br>'.date("h:i:s A", $value['time_started']).'</center></td>';
								if($value['time_finished'] != null)
									echo '<td><center>' .date("D, d M 20y", $value['time_finished']).'<br>'.date("h:i:s A", $value['time_started']).'</center></td>';
								else
									echo '<td><center>In process</center></td>';
								echo '</tr>';
							}							
						echo '</table>
					</div>
				</div>';				
			}	
			if (!empty($search_api)) {
				echo '
					<div class="row">
					<div class="col-md-12">
						<h3>In APIs</h3>
						<table class="table">
							<tr style="background-color: #E0E0E0;">
								<th class="col-md-1"><center>#ID</center></th>
								<th class="col-md-1">Code</th>
								<th class="col-md-3">Name</th>
								<th class="col-md-2">Template Used</th>
								<th class="col-md-2"><center>Created On</center></th>
								<th class="col-md-3 pull-right">Actions</th>
							</tr>';
							foreach ($search_api as $value) {
								echo '<tr>';
								echo '<td><center>' .$value['id'] .'</center></td>';
								echo '<td>' .$value['code'] .'</td>';
								echo '<td>' .$value['name'] .'</td>';
								echo '<td>' .$value['template_name'] .'</td>';
								echo '<td><center>' .date("D, d M 20y", $value['created_on']).'<br>'.date("h:i:s A (e)", $value['created_on']).'</center></td>';
								echo '<td class="pull-right">';
									$view = "api_view.php?id=".$value['id'];
									echo '<a class="btn btn-info button-view" href='.$view.' role="button" id='.$value['id'].'>View</a> ';
									$edit = "api_edit.php?id=".$value['id'];
									echo '<a class="btn btn-primary button-edit" href='.$edit.' role="button" id='.$value['id'].'>Edit</a> ';
									echo '<a class="btn btn-danger button-delete" href="#" role="button" data-toggle="modal" data-target="#delete" id='.$value['id'].'>Delete</a> ';
								echo '</td>';
								echo '</tr>';
							}							
						echo '</table>
					</div>
				</div>';				
			}
			if (!empty($search_template)) {
				echo '
					<div class="row">
					<div class="col-md-12">
						<h3>In Templatess</h3>
						<table class="table">
							<tr style="background-color: #E0E0E0;">
							<th class="col-md-1"><center>#ID</center></th>
							<th class="col-md-2">Name</th>
							<th class="col-md-1"><center>Parameters</center></th>
							<th class="col-md-1"><center>Links</center></th>
							<th class="col-md-2"><center>Created On</center></th>
							<th class="col-md-2"><center>Last Updated</center></th>
							<th class="col-md-3 pull-right">Actions</th>
							</tr>';
							foreach ($search_template as $value) {
								echo '<tr>';
								echo '<td><center>' .$value['id'] .'</center></td>';
								echo '<td>' .$value['name'] .'</td>';
								echo '<td><center>'.$value['parameters'].'</center></td>';
								echo '<td><center>'.$value['links'].'</center></td>';
								echo '<td><center>' .date("D, d M 20y", $value['created_on']).'<br>'.date("h:i:s A (e)", $value['created_on']).'</center></td>';
								echo '<td><center>' .date("D, d M 20y", $value['last_updated']).'<br>'.date("h:i:s A (e)", $value['last_updated']).'</center></td>';
								echo '<td class="pull-right">';
									echo '<a class="btn btn-info button-view" href="#" role="button" data-toggle="modal" data-target="#preview" id='.$value['id'].'>View</a> ';
									$edit = "template_edit.php?id=".$value['id'];
									echo '<a class="btn btn-primary button-edit" href='.$edit.' role="button" id='.$value['id'].'>Edit</a> ';
									echo '<a class="btn btn-danger button-delete" href="#" role="button" data-toggle="modal" data-target="#delete" id='.$value['id'].'>Delete</a> ';
								echo '</td>';
								echo '</tr>';
								}							
						echo '</table>
					</div>
				</div>';				
			}										
		?>
	</div>
<script src="js/dashboard.js"></script>
</body>
</html>