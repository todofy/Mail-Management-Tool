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
			if(empty($search_result)){
				echo '<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="alert alert-danger" style="text-align: center;">No Search Results Found</div>
						</div>
					</div>';
			}
			else{
				if(!empty($search_result)){
					echo '<div class="row">
						<div class="col-md-12">
							<table class="table">
								<tr style="background-color: #E0E0E0;">
									<th class="col-md-1">S. no</th>
									<th class="col-md-5">Type</th>
									<th class="col-md-2"><center>Result</center></th>
								</tr>';
								$i = 1;
								foreach ($search_result as $value) {
									echo '<tr>';
									echo '<td>' .$i.'</td>';
									echo '<td style="color:green;">' .$value['type'] .'</td>';
									echo '<td><center>' .'<a href = '.$value['link'].'>'.$value['value'] .'</a></center></td>';
									echo '</tr>';
									$i++;
								}
								
							echo '</table>
						</div>
					</div>';
				}
				else{
					echo '<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<div class="alert alert-info" style="text-align: center;">Mail ids are not retrieved yet.</div>
							</div>
						</div>';
				}
			}			
		?>
	</div>
</body>
</html>