<?php
if (!isset($_TEMPLATE_ADD_)) {
    throw new Exception("Code file not included for template_add.php!");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({
    	selector: "textarea",
    	theme: "modern",
    	plugins: [
        	"advlist autolink lists link image charmap print preview hr anchor pagebreak",
        	"searchreplace wordcount visualblocks visualchars code",
        	"insertdatetime media nonbreaking save table contextmenu directionality",
        	"emoticons template paste textcolor colorpicker textpattern imagetools"
    	],
    	toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    	toolbar2: "print preview media | forecolor backcolor emoticons",
    	image_advtab: true,
    	templates: [
	        {title: 'Test template 1', content: 'Test 1'},
    	    {title: 'Test template 2', content: 'Test 2'}
    		]
		});
	</script>
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
			    <li><a href="dashboard.php">Home</a></li>
			    <li><a href="template.php">Template</a></li>
			    <li class="active">Add</li>
			</ol>
			<div class="col-md-12">
				<h3>Create Template</h3>
				<form role="form" id="create-template">
					<div class="form-group">
	    				<label for="template-name"><h4>Template Name</h4></label>
	    				<input type="text" class="form-control" id="template-name" name="template-name" style="width: 40%; min-width: 200px">
	  				</div>
	  			    <div class="form-group">
	  			    	<h4 class="form-control-static">Template</h4>
	  					<textarea id="template-text" name="template-text" value="">Design your template here</textarea>
	  				</div>
	  				<button type="submit" class="btn btn-success" value="Submit" id="create">Create</button>
					<a href="api_add.php" class="btn btn-link">Or create API</a>
				</form>
			</div>
		</div>
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/template_add.js"></script>
</body>
</html>