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
		<div id="content-wrapper" class="col-md-10 col-md-offset-2">
			<div class="row">
					<ol class="breadcrumb">
					<li><a href="dashboard.php">Home</a></li>
					    <li class="active">API Handler</li>
					</ol>
				<div class="col-md-12">
					<div class="col-md-6 col-md-offset-3">
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
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
</body>
</html>