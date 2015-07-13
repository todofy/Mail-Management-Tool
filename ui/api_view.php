<?php
if (!isset($_API_VIEW_)) {
    throw new Exception("Code file not included for api_view.php!");
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
	<script src="./js/jquery-2.0.0.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/jAlert-v3.css" />
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
			    <li><a href="api.php">API</a></li>
			    <li class="active">View</li>
			</ol>
		</div>
		<div class="row">
			<div class="row">
				<div class="col-md-9">
					<h3>View API</h3>
				</div>
				<div class="col-md-3">
					<?php echo '<a href="api_edit.php?id='.$id.'" type="button" class="btn btn-primary pull-right">Edit</a>';?>
				</div>
			<div class="col-md-12">
				<div class="clearfix"></div>
				<?php
				    echo '<h4>API Name :&nbsp&nbsp '.$api_name.'</h4>';
				    echo '<h4>API Code :&nbsp&nbsp '.$api_code.'</h4>';
				    echo '<h4>API Call :&nbsp&nbsp '.$api_call.'</h4>';
				    echo '<hr>';
				    echo '<h4>API Response : </h4>';
				    echo '<div class="well">';
				    echo $template_text;
				    echo '</div>';
				?>
			</div>
		</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
</body>
</html>