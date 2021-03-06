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
              <li><a href="campaign_create.php">Create Campaign</a></li>
    			    <li class="active">Start Campaign</li>
    			</ol>
        </div>
  			<div class="col-xs-9">
    				<h3>Start Campaign</h3>
        </div>
        <div class="col-xs-3">
            <a href="#" type="button" class="btn btn-info button-view" role="button" data-toggle="modal" data-target="#preview" style="float:right; margin-right: 10px;" <?php echo 'id="'.$template_id.'"';?> >View sample mail</a>
        </div>
        <div class="col-xs-12">
    				<form class="form-inline" role="form" id="start_campaign" type="post" method="POST">
                <input type="text" class="form-control" name="secret_key" <?php echo 'value="'.$secret_key.'"';?> style="display: none;">
                <input type="text" class="form-control" name="api_code" <?php echo 'value="'.$api_code.'"';?> style="display: none;">
                <input type="text" class="form-control" name="subject" <?php echo 'value="'.$subject.'"';?> style="display: none;">
                <input type="text" class="form-control" name="from" <?php echo 'value="'.$from.'"';?> style="display: none;">
                <?php
                for($i=0 ; $i < $noOfMails ; $i++)
                {
                  echo '
                  <div style="background-color: #F5F5F5; padding: 10px; margin-bottom: 10px; border-radius: 10px; border: 1px solid #B9B9B9;">
                    <h3 style="margin-bottom:0px; margin-top:0px; text-align: right;">#'.($i+1).'</h3>    
                      <div class="form-group" style="padding-left:0px;">
                        <label for="to" style="padding-right:10px; margin-bottom:0px;"><h4>To:</h4></label>
                        <input type="text" class="form-control" id="to" name="payload['.$i.'].to" placeholder="someone@example.com" style="width:70%; min-width:250px;">
                      </div><br>';
                      if(!empty($params)){
                        foreach ($params as $value) {
                          $name = trim($value['name'],"{}");
                          echo '<div class="form-group">
                            <label for="params" style="padding-right:10px;"><h4>'.$name.':</h4></label>
                            <input type="text" class="form-control" id="params" name="payload['.$i.'].'.$name.'" placeholder="" style="width: 50%; min-width: 200px; margin-right: 20px;">
                          </div>'; 
                        }
                      }
                    echo '</div>';
                }
        				?>
                <a class="btn btn-success" id="start">Start</a>
    				</form>					
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
<script src="js/form2js.js"></script>
<script src="js/campaign_start.js"></script>
<script src="js/template.js"></script>
</body>
</html>