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
    	style_formats: [
                { title: 'Tahoma', inline: 'span', styles: { 'font-family': 'Tahoma'} },
                { title: 'Times New Roman', inline: 'span', styles: { 'font-family': 'Times New Roman'} },
                { title: 'Arial', inline: 'span', styles: { 'font-family': 'Arial'} },
                { title: 'Arial Black', inline: 'span', styles: { 'font-family': 'Arial Black'} },
                { title: 'Comic Sans MS', inline: 'span', styles: { 'font-family': 'Comic Sans MS'} },
                { title: 'Verdana', inline: 'span', styles: { 'font-family': 'Verdana'} },
                { title: 'Courier New', inline: 'span', styles: { 'font-family': 'Courier New'} },
                { title: '8px', inline: 'span', styles: { 'font-size': '8px'} },
                { title: '10px', inline: 'span', styles: { 'font-size': '10px'} },
                { title: '12px', inline: 'span', styles: { 'font-size': '12px'} },
                { title: '14px', inline: 'span', styles: { 'font-size': '14px'} },
                { title: '18px', inline: 'span', styles: { 'font-size': '18px'} },
                { title: '24px', inline: 'span', styles: { 'font-size': '24px'} },
                { title: '36px', inline: 'span', styles: { 'font-size': '36px'} }
            ],
    	plugins: [
        	"advlist autolink lists link image charmap print preview hr anchor pagebreak",
        	"searchreplace wordcount visualblocks visualchars code",
        	"insertdatetime media nonbreaking save table contextmenu directionality",
        	"emoticons template paste textcolor colorpicker textpattern imagetools fullscreen"
    	],
    	toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    	toolbar2: "print preview media | forecolor backcolor emoticons | fullscreen",
    	image_advtab: true,
    	templates: [
	        {title: 'Test template 1', content: 'Test 1'},
    	    {title: 'Test template 2', content: 'Test 2'}
    		]
		});
	</script>
</head>

<body>
	<div class="row" id="container">
		<?php
		include __DIR__ .'/header.php';
		include __DIR__ .'/sidebar.php';
		?>

		<!-- Main workspace starts from here -->
		<div id="content-wrapper" class="col-xs-10 col-xs-offset-2">
			<div class="col-xs-12">
				<ol class="breadcrumb">
				    <li><a href="dashboard.php">Home</a></li>
				    <li><a href="template.php">Template</a></li>
				    <li class="active">Add</li>
				</ol>
			</div>
			<div class="col-xs-12">
				<h3>Create Template</h3>
				<form role="form" id="create-template">
					<div class="form-group">
	    				<label for="template-name"><h4>Template Name</h4></label>
	    				<input type="text" class="form-control" id="template-name" name="template-name" style="width: 40%; min-width: 200px">
	  				</div>
	  			    <div class="form-group">
	  			    	<h4 class="form-control-static">Template</h4>
	  					<textarea id="template-text" name="template-text" value="">Design your template here.</textarea>
	  				</div>
	  				<button type="submit" class="btn btn-success" value="Submit" id="create">Create</button>
					<a href="api_add.php" class="btn btn-link">Or create API</a>
				</form>
			</div>
		</div>
	</div>
	<div class="col-xs-12"  id="wait-message" style="height:100%; position:fixed; left:0px; top:0px; background-color:rgba(0,0,0,0.3); z-index:100; display:none;">
		<div class="col-xs-6 col-xs-offset-3 col-sm-12 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4" style="position: fixed; top:25%;">
		    <div class="alert alert-info" style="padding: 15px;">
		    	<h4 style="margin-bottom:0px;"><center>Processing...</center></h4>
		    </div>
	    </div>
	</div>
	<div class="row"  id="warning-message">
		<div class="col-xs-12">
			<div class="well">
				<h2>Please switch to landscape mode.</h2>
			</div>
		</div>
	</div>
<script src="js/jAlert-v3.js"></script>
<script src="js/jAlert-functions.js"></script>
<script src="js/main.js"></script>
<script src="js/template_add.js"></script>
</body>
</html>