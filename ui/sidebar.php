<?php
if (!isset($_CODE_SIDEBAR_)) {
    throw new Exception("Code file not included for sidebar.php!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="css/sidebar.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="wrapper" class="col-xs-2">
    <div id="sidebar-wrapper" class="col-xs-2">
        <div class="col-xs-12" style="padding-left:0px; padding-right:0px;">
          <ul id="sidebar_menu" class="sidebar-nav sidebar-name">
              <li class="sidebar-nav sidebar-brand"><a id="menu-toggle" href="javascript:void(0)" style="pointer-events:none;">Menu<span id="main_icon" class="sub_icon"></span></a></li>
          </ul>
        </div>
        <div class="col-xs-12" style="padding-left:0px; padding-right:0px;">
          <ul class="sidebar-nav" id="sidebar">
                <li>
                    <a href="dashboard.php" style="font-size:15px;">
                       Dashboard<span class="sub_icon glyphicon glyphicon-home"></span>
                    </a>
                </li>
                <?php
                    if (isset($newuser->access[CALL_CAMPAIGN])){
                        echo '<li><a href="campaign_create.php" style="font-size:15px;">Send Mail<span class="sub_icon glyphicon glyphicon-envelope"></span></a></li>';
                    }
                ?>
                <li>
                    <a href="template.php" style="font-size:15px;">
                       Template<span class="sub_icon glyphicon glyphicon-pencil"></span>
                    </a>
                </li> 
                <li>
                    <a href="api.php" style="font-size:15px;">
                       API<span class="sub_icon glyphicon glyphicon-file"></span>
                    </a>
                </li> 
                <?php 
                    foreach ($newuser->access as $row) {
                        if ($row['link'] == '') continue;
                        echo"<li><a href=\"{$row['link']}\">{$row['display_name']}<span class='sub_icon glyphicon glyphicon-user'></span></a></li>";
                    } 
                ?>
                <?php
                    if (isset($newuser->access[RABBITMQ_ACCESS])){
                        echo '<li><a href="rabbitmq.php" style="font-size:15px;">Rabbit MQ<span class="sub_icon glyphicon glyphicon-wrench"></span></a></li>';
                    }
                ?>
                 
          </ul>
        </div>
    </div>    
</div>
<body>
</html>

