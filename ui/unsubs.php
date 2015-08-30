<?php
if (!isset($_UNSUBS_ACCESS_)) {
    throw new Exception("Code file not included for unsubs.php!");
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
				    <li class="active">Unsubscribed Emails</li>
				</ol>
			</div>			
		    <div class="col-xs-12">
		    	<h3>Unsubscribed Emails</h3>
		    </div>
			<?php
			if(empty($unsubs))
				echo '
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
						<div class="alert alert-info" style="text-align: center;">No unsubscribed emails present.</div>
					</div>';
			else{
				echo '
					<div class="col-xs-12">
						<table class="table">
							<tr style="background-color: #E0E0E0;">
								<th class="col-xs-1"><center>#ID<center></th>
								<th class="col-xs-3">Email</th>
								<th class="col-xs-4">Reason</th>
								<th class="col-xs-2"><center>Unsubscribed On</center></th>
								<th class="col-xs-2" style="text-align:right;">Actions</th>
							</tr>';
					foreach ($unsubs as $value) {
						echo '<tr>';
						echo '<td><center>' .$value['user_id'] .'</center></td>';
						echo '<td>' .$value['email'] .'</td>';
						echo '<td>' .$value['reason'] .'</td>';
						echo '<td><center>' .date("D, d M 20y", $value['time']).'<br>'.date("h:i:s A (e)", $value['time']).'</center></td>';
						echo '<td style="text-align:right;">';
						echo '<a class="btn btn-danger button-delete" href="#" role="button" data-toggle="modal" data-target="#remove" id='.$value['user_id'].'>Remove</a> ';
						echo '</td>';
						echo '</tr>';
					}
				echo '</table>
					</div>';
				}
			?>			
		</div>
		<div class="col-xs-12">
			<div id="remove" class="modal fade" role="dialog" style="z-index: 15000; top:20%; left:10%;">
	  			<div class="modal-dialog">
	    			<div class="modal-content">
	    				<div class="modal-header">
	        				<h4 class="modal-title">Remove Unsubscription</h4>
	      				</div>
	      				<div class="modal-body">
	        				<p>Are you sure you want to remove this email from unsubscriptions?</p>
	        				<br>
	        				<button type="button" class="btn btn-danger button-delete-confirm" data-dismiss="modal">Remove</button>
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
<script src="js/unsubs.js"></script>
</body>
</html>