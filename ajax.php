<?php

$db = new PDO("mysql:host=localhost;dbname=ajaxfileupload", "root", "root");

function add_file() {
	GLOBAL $db;
	if (isset($_FILES['file']['name']) && isset($_GET['my_form']) && $_GET['my_form'] == 'ajax_form') {

		$img_name = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$store = 'images/';
		$extension = array('jpg', 'jpeg', 'png');
		$get_extension = explode(".", $img_name);
		$end = end($get_extension);

		if (!in_array($end, $extension)) {
			echo "<div class='error'>Invalid image extension</div>";
		} else {
			move_uploaded_file($tmp_name, "$store/$img_name");
			$Query = $db->prepare("INSERT INTO file(file_name) VALUES (?)");
			$Query->execute(array($img_name));

			if ($Query) {
				echo "Image is uploaded";
			}
		}
	}
}
add_file();


function show_images() {
	GLOBAL $db;
	if (isset($_GET['my_form']) && $_GET['my_form'] == 'show') {
		$Query = $db->prepare("SELECT * FROM file ORDER BY id DESC");
		$Query->execute();

		if ($Query->rowCount() == 0) {
			echo "<div class='error'>No Images Yet.</div>";
		} else {
			while($r = $Query->fetch(PDO::FETCH_OBJ)) :
				echo "<img src='images/$r->file_name' class='img-res' onclick='delete_img($r->id);'>";
			endwhile;
		}
	}
}
show_images();


function delete_img() {
	GLOBAL $db;
	if (isset($_POST['id']) && isset($_GET['my_form']) && $_GET['my_form'] == 'delete') {
		$id = $_POST['id'];
		$Fetch_Query = $db->prepare("SELECT  file_name FROM file WHERE id = ?");
		$Fetch_Query->execute(array($id));
		$image_name = $Fetch_Query->fetch(PDO::FETCH_OBJ)->file_name;

		$Query = $db->prepare("DELETE FROM file WHERE id = ?");
		$Query->execute(array($id));
		if ($Query) {
			echo "<div class='success'>Your image is successfully deleted.</div>";
			unlink("images/" . $image_name);
		}
	}
}
delete_img();
?>