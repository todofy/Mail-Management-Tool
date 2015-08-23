<?php
if (!isset($_CODE_HEADER_)) {
    throw new Exception("Code file not included for header.php!");
}
?>

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="js/jquery-2.0.0.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/jAlert-v3.css" />
	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link rel="stylesheet" href="css/content.css" type="text/css">


	<div id="header" class="col-md-12 header-user-dropdown">
		<div class="row header-limiter">
			<div class="col-md-2"></div>
			<img id="logo" src="assets/logo.png" class="col-md-3">

			<nav class="col-md-3">
			</nav>

			<form class="col-md-2 navbar-form" role="search" id="search" action = "search.php" method = "POST">
	            <div class="input-group">
	                <input type="text" class="form-control" placeholder="Search..." size="50" name="key" id="search_key">
	                <span class="input-group-btn">
	                    <button type="submit" class="btn btn-default">
	                    <span class="glyphicon glyphicon-search"></span>
	                    </button>
	                </span>
	            </div>
	        </form>


			<div class="col-md-1 header-user-menu">
				<span class="glyphicon glyphicon-cog"></span>
				<ul class="col-md-1">
					<li><a href="profile.php">Profile</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
<!-- TODO: do something such that these scripts are always included at the bottom -->
<script src="js/header.js"></script>
