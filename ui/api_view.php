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
</head>

<body>
	<div class="row">
		<?php
		include __DIR__ .'/header.php';
		include __DIR__ .'/sidebar.php';
		?>

		<!-- Main workspace starts from here -->
		<div id="content-wrapper" class="col-xs-10 col-xs-offset-2">
			<div class="row">
				<div class="col-xs-12">
					<ol class="breadcrumb">
					    <li><a href="dashboard.php">Home</a></li>
					    <li><a href="api.php">API</a></li>
					    <li class="active">View</li>
					</ol>
				</div>
				<div class="col-xs-9">
					<h3>View API</h3>
				</div>
				<div class="col-xs-3">
					<a href="api_edit.php?id= <?php echo $id;?>" type="button" class="btn btn-primary" style="float:right; margin-right: 5px;">Edit</a>
				</div>
				<div class="col-xs-12">
				<?php
				    echo '<h4>API Name :&nbsp&nbsp '.$api_name.'</h4>';
				    echo '<h4>API Code :&nbsp&nbsp '.$api_code.'</h4>';
				    echo '<hr>';
				    echo '<h4>PHP Example : </h4>';
				    echo '<div class="well">';
				    echo $php_example;
				    echo '</div>';
				    echo '<hr>';
				    echo '<h4>API Response : </h4>';
				    echo '<div class="well">';
				    echo $template_text;
				    echo '</div>';
				?>
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
</body>
</html>