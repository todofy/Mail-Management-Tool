<?php
if (!isset($_CAMPAIGN_START_)) {
    throw new Exception("Code file not included for campaign_start.php!");
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
    			    <li class="active">Create Campaign</li>
    			</ol>
        </div>
  			<div class="col-xs-12">
  				<h3>Create the Campaign</h3>
  				<form role="form" id="add" type="post" action="" method="POST">
            <?php
            for($i=1 ; $i <= $noOfMails ; $i++)
            {
              echo ' <div class="col-xs-12">
                      <table class="table">
                        <tr style="background-color: #E0E0E0;">
                          <th class="col-xs-1"><center>#Mail '.$i.'</center></th>
                        </tr>
                      </table>';
              echo '<form role="form" id="mail"'.$i.'type="post">
                  <div class="form-group">
                    <label for="to"><h4>To:</h4></label>
                    <input type="text" class="form-control" id="to" name="to" placeholder="someone@example.com" style="width: 35%; min-width: 200px">
                  </div>';
                  foreach ($params as $value) {
                    $name = trim($value['name'],"{}");
                    echo '<div class="form-group">
                      <label for="params"><h4>'.$name.':</h4></label>
                      <input type="text" class="form-control" id="params" name=" ' .$name.'" placeholder="" style="width: 35%; min-width: 200px">
                    </div>'; 
              }
              echo '</form> </div>';
            }
    					?>
            <input type="submit" class="btn btn-success" name = "Create" value="Create" id = "create">
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
<script src="js/campaign_create.js"></script>
</body>
</html>