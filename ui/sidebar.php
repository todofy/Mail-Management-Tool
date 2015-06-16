

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/sidebar.css" rel="stylesheet" type="text/css">
<div id="wrapper" class="active">
      <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
          <li class="sidebar-nav sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fa fa-angle-left pull-right"></span></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
          <li>
              <a href="index.html">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
          </li>
          <?php 
            foreach ($newuser->access as $row)
            {
              echo"<li><a>{$row}<span class='sub_icon glyphicon glyphicon-link'></span></a></li>";
            } 
          
          ?>
                   
        </ul>
    </div>     
</div>

<script src="js/sidebar.js"></script>

