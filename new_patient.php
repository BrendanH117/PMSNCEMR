<html>
	<head>
		<title> Submission Return Page </title>
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

$patientID = date("dhis"); // Day of the month + Hour (in 24 format) + Minute + Second
$LastName = $_POST['lastname'];
$FirstName = $_POST['firstname'];
$Neighborhood = $_POST['neighborhood'];
$ContactInfo = $_POST['contactinfo'];
$Age = $_POST['age'];
$Sex = $_POST['sex'];
$BP = $_POST['BP'];
$HR = $_POST['HR'];
$Temp = $_POST['temp'];
$Height = $_POST['height'];
$Weight = $_POST['weight'];
$Allergies = $_POST['allergies'];
$LMP = $_POST['LMP'];
$ChiefComplaint = $_POST['chiefcomplaint'];
$TimestampDate = date("M.d");
$Diagnostic = "Not Specified";
$CommentAdded = date("M.d h:i:s A") . " - Added to database";


$sql = "INSERT INTO patients (patientID, LastName, FirstName, Neighborhood, ContactInfo, Age, Sex, BP, HR, Temp, Height, Weight, Allergies, LMP, ChiefComplaint, DateAdded, Comments)
	VALUES ('$patientID','$LastName', '$FirstName', '$Neighborhood', '$ContactInfo', '$Age','$Sex','$BP','$HR','$Temp','$Height','$Weight','$Allergies', '$LMP', '$ChiefComplaint','$TimestampDate','$CommentAdded')";

if(!mysqli_query($con,$sql)){
	echo "Error when inserting data. Error: ".mysqli_error($con);
} else {
	echo "Patient successfully added to database.<br>";
	echo "<h2>Patient ID is: "; echo $patientID;
}

$con->close();

?>
</h2><p><a href=patients/inputpatient.html>Add another patient</a></p><br>
<p><a href=patients/index.html>Go back to home page</a></p><br>
</body>
</html>