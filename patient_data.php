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

$id = $_POST['query'];
date_default_timezone_set("Asia/Manila");

if (isset($_POST['Comment'])) {

	$comment = $_POST['Comment'];
	$author = $_POST['Author'];
	$FullComment = date("M.d h:i:s A"). " - " . $comment . " by " . $author;
	$sql = "UPDATE patients SET Comments=CONCAT(Comments,'<br>','$FullComment') WHERE patientID=$id";
	if (!mysqli_query($con,$sql)){
		echo "Error when inserting data. <br> Error: ".mysqli_error($con). "<br>";
	} else {
		echo ("Added comment - " . $FullComment. "<br><br>");
	}
}

$raw_results = mysqli_query($con, "SELECT * FROM patients WHERE patientID ='$id'");

if(mysqli_num_rows($raw_results) != 0)
{
	while($row = mysqli_fetch_assoc($raw_results))
	{
        	echo "Patient ID: " . $row["patientID"] . "<br>"
		. "Name: " . $row["FirstName"]. " " . $row["LastName"] . "<br>"
		. "Barangay: " . $row["Neighborhood"]. "<br>"
		. "Contact Info: " . $row["ContactInfo"]. "<br>"
		. "Age: " . $row["Age"]. "<br>"
		. "Sex: " . $row["Sex"]. "<br>"
		. "BP: " . $row["BP"]. "<br>"
		. "HR: " . $row["HR"]. "<br>"
		. "Temp: " . $row["Temp"]. "<br>"
		. "Weight: " . $row["Weight"]. "<br>"
		. "Allergies: " . $row["Allergies"]. "<br>"
		. "LMP: " . $row["LMP"] . "<br>"
		. "Chief Complaint: " . $row["ChiefComplaint"]. "<br><br>"
		. "Diagnostics: " . "<br>"
		. "HEENT: " . $row["HEENT"] . "<br>"
		. "Lung: " . $row["Lung"] . "<br>"
		. "CV: " . $row["CV"] . "<br>"
		. "GI: " . $row["GI"] . "<br>"
		. "GU: " . $row["GU"] . "<br>"
		. "Neuro: " . $row["Neuro"] . "<br>"
		. "MSK: " . $row["MSK"] . "<br>"
		. "Endocrine: " . $row["Endocrine"] . "<br>"
		. "Skin: " . $row["Skin"] . "<br>"
		. "OB-Gyn: " . $row["OGGyn"] . "<br>"
		. "Heme: " . $row["Heme"] . "<br>"
		. "Psych: " . $row["Psych"] . "<br><br>"
		. "Comments: <br>"
		. $row["Comments"] . "<br><br>"
		. "Photos: <br>";

		$dirname = "./patients/patientphotos/" . $id . "/";
		$images = glob($dirname."*.{jpg,gif,png,jpeg}",GLOB_BRACE);
		foreach($images as $image) {
   		echo '<img src="'.$image.'" width="200" height="200" /><br /><br>';
		}

	}
}else
{
	echo "No results found<br>";
}
?>

<br>Insert a new comment <br>
<form action="/patient_data.php" method="post">
Comment: <br>
<input type="text" name="Comment" required><br>
Author: <br>
<input type="text" name="Author" required><br>
<input type="hidden" name="query" value="<?php echo "$id";?>"/> 
<input type="submit" value="Submit"><br><br>
</form>

Upload an image<br>
<form action="/uploadimage.php"  method="POST" enctype="multipart/form-data">
<input type="file" name="image"><br>
<input type="hidden" name="query" value="<?php echo "$id";?>"/> 
<input type="submit" name="submit_image" value="Upload">
</form>
<p><a href=patients/index.html>Go back to home page</a></p><br>
</body>
</html>