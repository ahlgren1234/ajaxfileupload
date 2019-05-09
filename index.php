<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax File Upload</title>
	
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
	<div class="container">
		<form enctype="multipart/form-data" id="upload_file">
			<div class="form-group">
				<input type="file" name="file" onchange="add_file();">
			</div>
			<div class="show"></div>
			<hr>
		</form>
		<div class="show_images"></div>
	</div>

	<script src="js/jquery-3.4.1.min.js"></script>	
	<script src="js/main.js"></script>
</body>
</html>