<?php
if (!isset($_CODE_HEADER_)) {
    throw new Exception("Code file not included for header.php!");
}
?>

	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link rel="stylesheet" href="css/content.css" type="text/css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="js/jquery-2.0.0.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/jAlert-v3.css" />

<header class="header-user-dropdown">

	<div class="header-limiter">
		<img id="logo" src="assets/logo.png">

		<nav>
			<a href="#">Messages<span class="header-new-feature">3</span></a>
			<a href="#">Logs<span class="header-new-feature">1</span></a>
			<a href="#">Reports<span class="header-new-feature">3</span></a>
			<a href="#">Warnings<span class="header-new-feature">2</span></a>
		</nav>

		<form class="navbar-form" role="search" id="search" action = "search.php" method = "POST">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." size="50" name="key" id="search_key">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>


		<div class="header-user-menu">
			<span class="glyphicon glyphicon-cog"></span>
			<ul>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>

	</div>

</header>
<!-- TODO: do something such that these scripts are always included at the bottom -->
<script src="js/header.js"></script>
