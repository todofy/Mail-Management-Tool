<?php
if (!isset($_CODE_DASHBOARD_)) {
    throw new Exception("Code file not included for dashboard.php!");
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
			    <li class="active">Home</li>
			</ol>
		</div>
		<div class="row">
		    <div class="col-md-12">
		    	<h3>Campaigns</h3>
		    </div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<tr>
						<th class="col-md-1">#ID</th>
						<th class="col-md-3">Related Admin</th>
						<th class="col-md-1"><center>API Code</center></th>
						<th class="col-md-1"><center>Total mails</center></th>
						<th class="col-md-1"><center>Mails processed</center></th>
						<th class="col-md-1"><center>Link clicks</center></th>
						<th class="col-md-2"><center>Started On</center></th>
						<th class="col-md-2"><center>Finished On</center></th>
					</tr>
					<?php
						foreach ($campaigns as $value) {
							echo '<tr class="campaign-row" data-href="campaign_view.php?id='.$value['id'].'" style="cursor:pointer;">';
							echo '<td>'.$value['id'].'</td>';
							echo '<td>' .$value['email'] .'</td>';
							echo '<td><center>' .$value['api_code'] .'</center></td>';
							echo '<td><center>' .$value['payload_length'] .'</center></td>';
							echo '<td><center>' .$value['mails_processed'] .'</center></td>';
							echo '<td><center>' .$value['clicks'] .'</center></td>';
							echo '<td><center>' .date("D, d M 20y", $value['time_started']) .'</center></td>';
							if($value['time_finished'] != null)
								echo '<td><center>' .date("D, d M 20y", $value['time_finished']) .'</center></td>';
							else
								echo '<td><center>In process</center></td>';
							echo '</tr>';
						}
					?>
				</table>
			</div>
		</div>		
	</div>
<script src="js/dashboard.js"></script>
</body>
</html>