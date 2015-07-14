<?php
if (!isset($_CODE_DASHBOARD_)) {
    throw new Exception("Code file not included for dashboard.php!");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<?php
	include __DIR__ .'/header.php';
	include __DIR__ .'/sidebar.php';
	?>

	<!-- Main workspace starts from here -->
	<div id="content-wrapper">
		<div class="row">
			<ol class="breadcrumb">
			    <li class="active">Home</li>
			</ol>
			<div class="col-md-6">
				<p class="text-justify">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac libero eros. Proin aliquet lacinia lorem accumsan vehicula. Suspendisse potenti. Sed laoreet ullamcorper tortor eu faucibus. Aenean eu mi laoreet, porttitor neque et, placerat dui. Donec sit amet maximus nisl. Quisque vulputate augue ac lorem lacinia vestibulum. Proin erat nibh, mollis ac turpis quis, sollicitudin feugiat ligula. Aliquam eu turpis metus. In est purus, scelerisque sit amet vestibulum quis, aliquam ac eros.

					Donec et urna eget massa rhoncus pharetra. Maecenas id dapibus mi, a scelerisque magna. Phasellus aliquet auctor nulla sed dapibus. Praesent sed nibh in dolor consectetur eleifend. Ut finibus purus eu purus sodales tempor. Suspendisse id fringilla enim. Vestibulum sit amet nunc sit amet arcu vestibulum interdum non eu elit. Praesent varius felis eu eleifend commodo.

					Nunc dolor ex, elementum eget tincidunt sit amet, porta ac justo. Donec et purus at augue tristique pellentesque ut sed mi. Sed et erat vitae odio ultrices gravida et eget leo. Maecenas ante elit, dictum ut fermentum posuere, semper et risus. Etiam viverra maximus tortor, sollicitudin consectetur elit eleifend in. Ut nec augue lobortis, facilisis tellus et, dictum eros. Mauris pretium libero ac diam placerat, posuere varius lacus gravida.

					Aenean accumsan vestibulum lorem, a consectetur mauris. Fusce in erat sed ex mattis suscipit. Donec magna elit, laoreet at massa sit amet, sodales ornare nulla. Mauris vitae pretium ipsum. Ut nec facilisis eros, in imperdiet felis. Etiam rutrum tempus consectetur. In convallis nunc metus, sed lacinia sapien rutrum eu. Curabitur rutrum tortor id massa pulvinar varius et id dui.

					Vestibulum pellentesque, dolor eu pretium scelerisque, erat lectus placerat est, non aliquet elit libero non lacus. Nunc auctor vehicula sem, a tincidunt neque hendrerit ac. Nam rutrum varius neque, sit amet accumsan nunc ultrices eleifend. Aliquam mattis hendrerit leo a aliquam. Praesent semper turpis arcu, pulvinar volutpat justo vehicula eget. In euismod lacinia nunc. Duis aliquet lorem eu nunc bibendum semper. Aliquam eget enim rutrum, vehicula augue non, congue magna. Suspendisse eleifend sem in purus scelerisque, sit amet pulvinar magna feugiat.
				</p>	
			</div>
			<div class="col-md-6">
				<p class="text-justify">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac libero eros. Proin aliquet lacinia lorem accumsan vehicula. Suspendisse potenti. Sed laoreet ullamcorper tortor eu faucibus. Aenean eu mi laoreet, porttitor neque et, placerat dui. Donec sit amet maximus nisl. Quisque vulputate augue ac lorem lacinia vestibulum. Proin erat nibh, mollis ac turpis quis, sollicitudin feugiat ligula. Aliquam eu turpis metus. In est purus, scelerisque sit amet vestibulum quis, aliquam ac eros.

					Donec et urna eget massa rhoncus pharetra. Maecenas id dapibus mi, a scelerisque magna. Phasellus aliquet auctor nulla sed dapibus. Praesent sed nibh in dolor consectetur eleifend. Ut finibus purus eu purus sodales tempor. Suspendisse id fringilla enim. Vestibulum sit amet nunc sit amet arcu vestibulum interdum non eu elit. Praesent varius felis eu eleifend commodo.

					Nunc dolor ex, elementum eget tincidunt sit amet, porta ac justo. Donec et purus at augue tristique pellentesque ut sed mi. Sed et erat vitae odio ultrices gravida et eget leo. Maecenas ante elit, dictum ut fermentum posuere, semper et risus. Etiam viverra maximus tortor, sollicitudin consectetur elit eleifend in. Ut nec augue lobortis, facilisis tellus et, dictum eros. Mauris pretium libero ac diam placerat, posuere varius lacus gravida.

					Aenean accumsan vestibulum lorem, a consectetur mauris. Fusce in erat sed ex mattis suscipit. Donec magna elit, laoreet at massa sit amet, sodales ornare nulla. Mauris vitae pretium ipsum. Ut nec facilisis eros, in imperdiet felis. Etiam rutrum tempus consectetur. In convallis nunc metus, sed lacinia sapien rutrum eu. Curabitur rutrum tortor id massa pulvinar varius et id dui.

					Vestibulum pellentesque, dolor eu pretium scelerisque, erat lectus placerat est, non aliquet elit libero non lacus. Nunc auctor vehicula sem, a tincidunt neque hendrerit ac. Nam rutrum varius neque, sit amet accumsan nunc ultrices eleifend. Aliquam mattis hendrerit leo a aliquam. Praesent semper turpis arcu, pulvinar volutpat justo vehicula eget. In euismod lacinia nunc. Duis aliquet lorem eu nunc bibendum semper. Aliquam eget enim rutrum, vehicula augue non, congue magna. Suspendisse eleifend sem in purus scelerisque, sit amet pulvinar magna feugiat.
				</p>	
			</div>
		</div>
		
	</div>

</body>
</html>