<html>
	<head>
		<title> Patient Data Page </title>
	</head>
<body>
	<style>
	body {
	-moz-transform: scale(1.3); /* for Firefox, default 1*/
	zoom:130%; /* For Chrome, IE, default 100%*/}
	</style>
<?php
$con = mysqli_connect("localhost",'root','', 'patients');
if(!$con){
	echo 'Error connecting to server';
}

$id = $_POST["query"];
$target_dir = "./patients/patientphotos";

if (!is_dir($target_dir . "/" . $id . "/")) {
    mkdir($target_dir . "/" . $id . "/", 0777);
}

if(isset($_FILES['image'])){
        $tmp_name = $_FILES["image"]["tmp_name"];
        $name = basename($_FILES["image"]["name"]);
        move_uploaded_file($tmp_name, "$target_dir/$id/$name");
	echo $_FILES["image"]["name"] . " stored in " . "$target_dir/$id/$name";
	}
?>

<p><a href=patients/index.html>Go back to home page</a></p><br>
</body>
</html>