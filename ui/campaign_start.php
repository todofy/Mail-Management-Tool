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
        <div class="col-xs-12">
    			<ol class="breadcrumb">
    			    <li><a href="dashboard.php">Home</a></li>
              <li><a href="campaign_create.php">Create Campaign</a></li>
    			    <li class="active">Start Campaign</li>
    			</ol>
        </div>
  			<div class="col-xs-12">
    				<h3>Start Campaign</h3>
        </div>
        <div class="col-xs-12">
    				<form role="form" id="start_campaign" type="post" method="POST">
              <?php
              for($i=0 ; $i < $noOfMails ; $i++)
              {
                echo '
                <div class="well">
                  <h4 style="float:right; margin-top:0px;">#'.($i+1).'</h4>    
                    <div class="form-group">
                      <label for="to"><h4>To:</h4></label>
                      <input type="text" class="form-control" id="to" name="mail['.$i.'].to" placeholder="someone@example.com" style="width: 35%; min-width: 200px">
                    </div>';
                      foreach ($params as $value) {
                        $name = trim($value['name'],"{}");
                        echo '<div class="form-group">
                          <label for="params"><h4>'.$name.':</h4></label>
                          <input type="text" class="form-control" id="params" name="mail['.$i.'].'.$name.'" placeholder="" style="width: 35%; min-width: 200px">
                        </div>'; 
                  }
                  echo '</div>';
              }
      				?>
              <a class="btn btn-success" id="start">Start</a>
    				</form>					
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
<script src="js/form2js.js"></script>
<script src="js/campaign_start.js"></script>
</body>
</html>