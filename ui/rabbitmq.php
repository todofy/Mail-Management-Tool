<?php
if (!isset($_RABBIT_MQ_)) {
    throw new Exception("Code file not included for rabbitmq.php!");
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
				    <li class="active">Rabbit MQ</li>
				</ol>
			</div>			
		    <div class="col-xs-9">
		    	<h3>Rabbit MQ workers</h3>
		    </div>
		    <div class="col-xs-3">
				<a href="#" type="button" class="btn btn-success" id="add-worker" style="float:right; margin-right: 10px;">Add Worker</a>
			</div>
			<?php
			if(empty($workers))
				echo '
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
						<div class="alert alert-info" style="text-align: center;">No workers active.</div>
					</div>';
			else{
				echo '
					<div class="col-xs-12">
						<table class="table">
							<tr style="background-color: #E0E0E0;">
								<th class="col-xs-1">S. No.</th>
								<th class="col-xs-6"><center>Process #ID</center></th>
								<th class="col-xs-3"><center>Started On<center></th>
								<th class="col-xs-2" style="text-align:right;">Actions</th>
							</tr>';
						echo '</table>
					</div>';
				}
			?>			
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