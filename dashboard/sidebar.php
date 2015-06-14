<?php
//session_start();
$SECURE=true;
require "../libs/database.php";
require "../libs/user.php";
// to get the access ids of the current set admin
  $id=$_SESSION['user_id'];
  $newuser= new user($id);
  //$result = database::SQL("SELECT name,description from acl,admin_access where admin_access.access_id= acl.id AND admin_access.admin_id=?",array('i',$id));
?>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  .row{
    margin-left:0px;
    margin-right:0px;
}

#wrapper {
    padding-left: 70px;
    transition: all .4s ease 0s;
    height: 100%;
}

#sidebar-wrapper {
    margin-left: -250px;
    margin-top: 0px;
    left: 70px;
    top: 0px;
    width: 250px;
    background: #222;
    position: fixed;
    height: 100%;
    z-index: 10000;
    transition: all .4s ease 0s;
}

.sidebar-nav {
    display: block;
    float: left;
    width: 250px;
    list-style: none;
    margin: 0;
    padding: 0;
}
#page-content-wrapper {
    padding-left: 0;
    margin-left: 0;
    width: 100%;
    height: auto;
}
#wrapper.active {
    padding-left: 250px;
}
#wrapper.active #sidebar-wrapper {
    left: 250px;
}

#wrapper.declick{
  pointer-events:none;
}

#menu-toggle.click{
  pointer-events:auto;
}

#page-content-wrapper {
  width: 100%;
}

#sidebar_menu li a, .sidebar-nav li a {
    color: #999;
    display: block;
    float: left;
    text-decoration: none;
    width: 250px;
    background: #252525;
    cursor: pointer;
    border-top: 1px solid #373737;
    border-bottom: 1px solid #1A1A1A;
    -webkit-transition: background .5s;
    -moz-transition: background .5s;
    -o-transition: background .5s;
    -ms-transition: background .5s;
    transition: background .5s;
}
.sidebar_name {
    padding-top: 25px;
    color: #fff;
    opacity: .7;
}

.sidebar-nav li {
  line-height: 40px;
  text-indent: 20px;
}

.sidebar-nav li a {
  color: #999999;
  display: block;
  text-decoration: none;
}

.sidebar-nav li a:hover {
  color: #fff;
  background: rgba(255,255,255,0.2);
  text-decoration: none;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  height: 65px;
  line-height: 60px;
  font-size: 18px;
}

.sidebar-nav span{
  font-size: 18px;
}

.sidebar-nav > .sidebar-brand a {
  color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: #fff;
  background: none;
}

#main_icon
{
    float:right;
   padding-right: 30px;
   padding-top:20px;
    transition: transform 0.4s;
    -webkit-transition: transform 0.4s;
}

#main_icon.flip{
   transform: rotateY(180deg) translateX(10px);
   -webkit-transform: rotateY(180deg) translateX(10px); /* Safari and Chrome */
   -o-transform: rotateY(180deg) translateX(10px); /* Opera */
   -moz-transform: rotateY(180deg) translateX(10px); /* Firefox */
}

.sub_icon
{
    float:right;
   padding-right: 65px;
   padding-top:10px;
}
.content-header {
  height: 65px;
  line-height: 65px;
}

.content-header h1 {
  margin: 0;
  margin-left: 20px;
  line-height: 65px;
  display: inline-block;
}

.fa{
  padding-left: -20px;
  margin-left: -20px;
}
#header{
  left: 230px;
  width: 84%;
  height: 65px;
  vertical-align: center;
  padding-top: 0px;
  position: absolute;
  transition: all 0.4s;
}
#header.push{
  left: 0px;
  width: 100%;
}

@media (max-width:767px) {
    #wrapper {
    padding-left: 70px;
    transition: all .4s ease 0s;
}
#sidebar-wrapper {
    left: 70px;
}
#wrapper.active {
    padding-left: 250px;
}
#wrapper.active #sidebar-wrapper {
    left: 150px;
    width: 150px;
    transition: all .4s ease 0s;
}
}

</style>

<script type="text/javascript">
  $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        $("#wrapper").toggleClass("declick");
        $("#main_icon").toggleClass("flip");
        $("#menu-toggle").addClass("click");
        $("#header").toggleClass("push");
});
</script>
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
