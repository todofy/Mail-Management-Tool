<?php
if (!isset($_CODE_SIDEBAR_)) {
    throw new Exception("Code file not included for sidebar.php!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="css/sidebar.css" rel="stylesheet" type="text/css">
  <script src="js/sidebar.js"></script>
</head>

<body>
<div id="wrapper" class="col-xs-2">
    <div id="sidebar-wrapper" class="col-xs-2">
        <div class="col-xs-12" style="padding-left:0px; padding-right:0px;">
          <ul id="sidebar_menu" class="sidebar-nav sidebar-name">
              <li class="sidebar-nav sidebar-brand"><a id="menu-toggle" href="javascript:void(0)">Menu<span id="main_icon" class="sub_icon glyphicon glyphicon-chevron-up"></span></a></li>
          </ul>
        </div>
        <div class="col-xs-12" style="padding-left:0px; padding-right:0px;" id="menu">
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
                    if (isset($newuser->access[VIEW_ADMIN])){
                        echo '<li><a href="admin_view.php" style="font-size:15px;">Admins<span class="sub_icon glyphicon glyphicon-user"></span></a></li>';
                    }
                ?>
                <?php
                    if (isset($newuser->access[UNSUB_EMAILS])){
                        echo '<li><a href="unsubs.php" style="font-size:15px;">Unsubscriptions<span class="sub_icon glyphicon glyphicon-remove-circle"></span></a></li>';
                    }
                ?>
                 
          </ul>
        </div>
    </div>    
</div>
<body>
</html>

