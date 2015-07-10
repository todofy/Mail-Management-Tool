<?php
if (!isset($_CODE_HEADER_)) {
    throw new Exception("Code file not included for header.php!");
}
?>

	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/content.css" type="text/css">

<header class="header-user-dropdown">

	<div class="header-limiter">
		<img id="logo" src="assets/logo.png">

		<nav>
			<a href="#">Messages<span class="header-new-feature">3</span></a>
			<a href="#">Logs<span class="header-new-feature">1</span></a>
			<a href="#">Reports<span class="header-new-feature">3</span></a>
			<a href="#">Warnings<span class="header-new-feature">2</span></a>
		</nav>


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