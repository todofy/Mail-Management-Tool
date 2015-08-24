<?php
if (!isset($_CAMPAIGN_ADD_)) {
    throw new Exception("Code file not included for admin_add.php!");
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
    			    <li class="active">Add Campaign</li>
    			</ol>
        </div>
  			<div class="col-xs-12">
  				<h3>Add a Campaign</h3>
          <ol class="breadcrumb">
              <?php if(isset($_GET['err']))
              echo $_GET['err'];
              ?>
          </ol>
  				<form role="form" id="add" type="post" action="campaign_create.php" method="POST">
    					<div class="form-group">
      					<label for="secret-key"><h4>Secret Key:</h4></label>
      					<input type="text" class="form-control" id="secret_key" name="secret_key" placeholder="" style="width: 35%; min-width: 200px">
    					</div>
              <div class="form-group">
                <label for="email"><h4>From:</h4></label>
                <input type="email" class="form-control" id="email" name="from" placeholder="someone@domain.com" style="width: 35%; min-width: 200px">
              </div>
              <div class="form-group">
                <label for="subject"><h4>Subject:</h4></label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="" style="width: 35%; min-width: 200px">
              </div>
              <div class="form-group">
              <label class="control-label"><h4>Select API</h4></label>
              <select class="form-control" name="api" style="width:auto; display:inline-block; margin-left: 10px;">
                <?php
                  foreach ($API as $value) {
                    echo '<option>'.$value['code'].'</option>';
                  }
                ?>
              </select>
          </div>
              <div class="form-group">
                <label for="NO_Mails"><h4>Number Of Mails:</h4></label>
                <input type="text" class="form-control" id="NO_mails" name="NO_Mails" placeholder="" style="width: 35%; min-width: 200px">
              </div>
    					<input type="submit" class="btn btn-success" name = "submit" value="Add" id = "add">

    					<div class="clearfix"></div>
    					<div class="bs-callout bs-callout-info">
    						<h4>Note</h4>
    						The secret key was sent to the admin's mail address. use the same secret key.
    					</div>
    					
  				</form>					
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
<script src="js/campaign_add.js"></script>
</body>
</html>