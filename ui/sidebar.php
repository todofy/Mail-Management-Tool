<?php
if (!isset($_CODE_SIDEBAR_)) {
    throw new Exception("Code file not included for sidebar.php!");
}
?>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/sidebar.css" rel="stylesheet" type="text/css">
<div id="wrapper" class="active">
    <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
            <li class="sidebar-nav sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="sub_icon glyphicon glyphicon-chevron-left"></span></a></li>
        </ul>
      <ul class="sidebar-nav" id="sidebar">
            <li>
                <a href="dashboard.php" style="font-size:15px;">
                   Dashboard<span class="sub_icon glyphicon glyphicon-home"></span>
                </a>
            </li>
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
      </ul>
  </div>     
</div>

<!-- TODO: do something such that these scripts are always included at the bottom -->
<script src="js/sidebar.js"></script>

