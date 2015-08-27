<?php
if (!isset($_CAMPAIGN_CREATE_)) {
    throw new Exception("Code file not included for campaign_create.php!");
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
      			    <li class="active">Create Campaign</li>
      			</ol>
        </div>
      <?php
      if($api_found){
        echo '
  			<div class="col-xs-12">
  				  <h3>Create a Campaign</h3>
    				<form class="form-inline" role="form" id="create_form" type="post" action="campaign_start.php" method="POST">
      					<div class="form-group col-xs-12" id="secret-key-input">
          					<label class="col-sm-2" for="secret-key" style="padding-top:0px; padding-left:0px;"><h4>Secret Key:</h4></label>              
          					<input type="text" class="form-control" id="secret_key" name="secret_key" placeholder="Enter your secret key" style="width:100%; max-width:450px;">
      					</div>
                <div class="form-group col-xs-12" id="from-input">
                    <label class="col-sm-2" for="email" style="padding-top:0px; padding-left:0px; "><h4>From:</h4></label>                    
                    <input type="email" class="form-control" id="from" name="from" placeholder="someone@domain.com" style="width:100%; max-width:450px;">
                </div>
                <div class="form-group col-xs-12">
                    <label class="col-sm-2" for="subject" style="padding-top:0px; padding-left:0px;"><h4>Subject:</h4></label>            
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject for campaign" style="width:100%; max-width:450px;">                   
                </div>
                <div class="col-xs-12">
                    <div class="form-group" style="padding-right:10px;">
                        <label><h4>Select API</h4></label>
                        <select class="form-control" name="api" style="width:auto; display:inline-block; margin-left: 10px;">';
                              foreach ($API as $value) {
                                echo '<option>'.$value['code'].'</option>';
                              }
                        echo '
                        </select>
                    </div>
                    <div class="form-group" id="mails-input" style="padding-right:10px;">
                        <label for="NO_Mails" style="padding-top:0px; padding-right:5px;"><h4>Number Of Mails:</h4></label>
                        <input type="text" class="form-control" id="NO_mails" name="NO_Mails" style="width: 60%; max-width:50px;">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" value="create" id="create">Create</button> 
                    </div>
                </div>                        					
    				</form>				
  			</div>';
      }
      else{
        echo '<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
              <div class="alert alert-danger" style="text-align: center;">No APIs available.<a href="api_add.php"> Create a new API.</a></div>
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
<script src="js/create_campaign.js"></script>
</body>
</html>