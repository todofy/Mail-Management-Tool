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
					    <li class="active">View Campaign</li>
					</ol>
				</div>
				<?php
				if($error){
					echo '
						<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
							<div class="alert alert-danger" style="text-align: center;">Campaign doesn\'t exist in database</div>
						</div>';
				}
				else{
				echo '
					<div class="col-xs-9">
						<h3>Campaign #'.$campaign_id.'</h3>
					</div>
					<div class="col-xs-3">';
						echo '<a href="#" type="button" class="btn btn-info button-view" role="button" data-toggle="modal" data-target="#preview" style="float:right; margin-right: 10px;" id="'.$template_id.'">View sample mail</a>
					</div>';
					if(!empty($mails)){
						echo '
							<div class="col-xs-12">
								<table class="table">
									<tr style="background-color: #E0E0E0;">
										<th class="col-xs-1"><center>Mail #ID</center></th>
										<th class="col-xs-3">Status</th>
										<th class="col-xs-3">Addressee</th>
										<th class="col-xs-1"><center>Link clicks</center></th>
										<th class="col-xs-2"><center>Started On</center></th>
										<th class="col-xs-2"><center>Finished On</center></th>
									</tr>';
									foreach ($mails as $value) {
										echo '<tr>';
										echo '<td><center>' .$value['id'].'</center></td>';
										if($value['status']==0)
											echo '<td>' .$value['description'] .'</td>';
										elseif($value['status']==1)
											echo '<td style="color:green;">' .$value['description'] .'</td>';
										else
											echo '<td style="color:red;">' .$value['description'] .'</td>';
										echo '<td>'.$value['sent_to'].'</td>';
										echo '<td><center>' .$value['clicks'] .'</center></td>';
										if($value['time_started'] != null)
											echo '<td><center>' .date("D, d M 20y", $value['time_started']).'<br>'.date("h:i:s A (e)", $value['time_started']).'</center></td>';
										else
											echo '<td><center> -NA- </center></td>';
										if($value['time_finished'] != null)
											echo '<td><center>' .date("D, d M 20y", $value['time_finished']).'<br>'.date("h:i:s A (e)", $value['time_finished']).'</center></td>';
										else
											echo '<td><center> -NA- </center></td>';
										echo '</tr>';
									}
									
								echo '</table>
							</div>';
					}
					else{
						echo '<div class="row">
								<div class="col-xs-6 col-xs-offset-3">
									<div class="alert alert-info" style="text-align: center;">Mail ids are not retrieved yet.</div>
								</div>
							</div>';
					}
				}			
			?>
		</div>
		<div class="col-xs-12">
			<div id="preview" class="modal fade" role="dialog" style="z-index: 15000; top:40px;">
	  			<div class="modal-dialog" style="margin:auto; width: 90%; overflow-y: initial;">
	    			<div class="modal-content">
	    				<div class="modal-header">
	        				<h4 class="modal-title">Sample Mail</h4>
	      				</div>
	      				<div class="modal-body"style="overflow-y: auto;">
	      					<div class="well" id="template-preview" ></div>
	      				</div>
	  					<div class="modal-footer" style="margin-top: -20px;">
	        				<button type="button" class="btn btn-link" data-dismiss="modal">Back</button>
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
<script src="js/main.js"></script>
<script src="js/template.js"></script>
</body>
</html>