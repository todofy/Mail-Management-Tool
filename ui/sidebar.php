<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/sidebar.css" rel="stylesheet" type="text/css">
<div id="wrapper" class="active">
      <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
          <li class="sidebar-nav sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fa fa-angle-left pull-right"></span></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
          <li>
              <a href="dashboard.php" style="font-size:15px;">
                    Dashboard<span class="sub_icon fa fa-laptop" style="padding-right: 25px;"></span>
              </a>
          </li>
          <?php 
            foreach ($newuser->access as $row)
            {
              echo"<li><a>{$row}<span class='sub_icon glyphicon glyphicon-user'></span></a></li>";
            } 
          
          ?>
                   
        </ul>
    </div>     
</div>

<script src="js/sidebar.js"></script>

