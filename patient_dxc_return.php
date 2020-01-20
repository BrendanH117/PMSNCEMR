<html>
	<head>
		<title> Patient DxC Return </title>
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

$id = $_POST['query'];
$author = $_POST['author'];
$FullComment = date("M.d h:i:s A"). " - DxC added by " . $author;
$sql = "UPDATE patients SET Comments=CONCAT(Comments,'<br>','$FullComment') WHERE patientID=$id";
mysqli_query($con, $sql);

$dxc_categories = array('HEENT','Lung','CV','GI','GU','Neuro','MSK','Endocrine','Skin','OGGyn','Heme','Psych');

foreach($dxc_categories as $dxc){
	if (empty($_POST[$dxc]) && !isset($_POST['Other' . $dxc])){
		${"diag_$dxc"} = "None";
		} elseif (empty($_POST[$dxc])) {
		${"diag_$dxc"} = "";
		} if (!empty($_POST[$dxc])){
			${"diag_$dxc"} = implode(', ', $_POST[$dxc]);
		} if (isset($_POST['Other' . $dxc]) && !empty($_POST['Other' . $dxc . 'Entry'])){
			${"diag_$dxc"} .= " Other: " . $_POST['Other' . $dxc . 'Entry'];
		} elseif (isset($_POST['Other' . $dxc]) && empty($_POST['Other' . $dxc . 'Entry'])){
			echo "Error in " . $dxc . ": 'Other' cannot be marked without filling out field. Other diagnostics have been saved.";
		}
}

$sql = "UPDATE patients 
	SET HEENT = '$diag_HEENT', Lung = '$diag_Lung', CV = '$diag_CV', GI = '$diag_GI', GU = '$diag_GU', Neuro = '$diag_Neuro', MSK = '$diag_MSK', Endocrine = '$diag_Endocrine', Skin = '$diag_Skin', OGGyn = '$diag_OGGyn', Heme = '$diag_Heme', Psych = '$diag_Psych'
	WHERE patientID = '$id'";

if(!mysqli_query($con,$sql)){
	echo "Error when inserting data. Error: ".mysqli_error($con);
} else {
	mysqli_query($con, "UPDATE patients SET Comments=CONCAT(Comments,'<br>', date('M.d h:i:s A'). ' - Diagnostic Updated') WHERE patientID=$id");
	echo "Patient data updated with DxC successfully.";
}

$con->close();

?>
<p><a href=patients/index.html>Go back to home page</a></p><br>
</body>
</html>