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


	<div id="header" class="col-xs-12 header-user-dropdown">
		<div class="row header-limiter">
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
			<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2" id="logo-container">
				<img id="logo" src="assets/logo.png">
			</div>

			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
			</div>

			<div class="col-xs-5 col-sm-5 col-md-6 col-lg-6">
				<form class="navbar-form" role="search" id="search" action = "search.php" method = "POST">
		            <div class="input-group" id="search_bar">
		                <input type="text" class="form-control" placeholder="Search..." name="key" id="search_key">
		                <span class="input-group-btn">
		                    <button type="submit" class="btn btn-default" id="search-btn">
		                    <span class="glyphicon glyphicon-search"></span>
		                    </button>
		                </span>
		            </div>
		        </form>
		    </div>

		    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
				<div class="header-user-menu">
					<span class="glyphicon glyphicon-cog" id="cog-sym"></span>
					<ul class="row" id="drop-menu">
						<li><a href="profile.php">Profile</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<!-- TODO: do something such that these scripts are always included at the bottom -->
<script src="js/header.js"></script>
