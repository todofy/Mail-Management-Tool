<?php
if (!isset($_API_HANDLER_)) {
    throw new Exception("Code file not included for api_handler.php!");
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
					    <li class="active">API Handler</li>
					</ol>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-6 col-xs-offset-3">
						<?php
							if($error) 
								echo '<div class="alert alert-danger" style="text-align: center;">'.$res.'</div>';
							else
								echo '<div class="alert alert-success" style="text-align: center;">'.$res.'</div>';
						?>
					</div>
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
</body>
</html>