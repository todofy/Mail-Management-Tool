<?php
if (!isset($_CAMPAIGN_VIEW_)) {
    throw new Exception("Code file not included for campaign_view.php!");
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
			    <li class="active">View Campaign</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Campaign #<?php echo $campaign_id?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<tr>
						<th class="col-md-1">Mail #ID</th>
						<th class="col-md-5">Status</th>
						<th class="col-md-2"><center>Link clicks</center></th>
						<th class="col-md-2"><center>Started On</center></th>
						<th class="col-md-2"><center>Finished On</center></th>
					</tr>
					<?php
						foreach ($mails as $value) {
							echo '<tr>';
							echo '<td>' .$value['id'].'</td>';
							if($value['status']==0)
								echo '<td>' .$value['description'] .'</td>';
							elseif($value['status']==1)
								echo '<td style="color:green;">' .$value['description'] .'</td>';
							else
								echo '<td style="color:red;">' .$value['description'] .'</td>';
							echo '<td><center>' .$value['clicks'] .'</center></td>';
							echo '<td><center>' .date("D, d M 20y", $value['time_started']) .'</center></td>';
							if($value['time_finished'] != null)
								echo '<td><center>' .date("D, d M 20y", $value['time_finished']) .'</center></td>';
							else
								echo '<td><center> -NA- </center></td>';
							echo '</tr>';
						}
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>