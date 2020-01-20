<html>
	<head>
		<title> Search Results </title>
	</head>
<body>
	<style>
	body {
	-moz-transform: scale(1.3); /* for Firefox, default 1*/
	zoom:130%; /* For Chrome, IE, default 100%*/}
	</style>
<form>
<?php
$con = mysqli_connect("localhost",'root','', 'patients');
if(!$con){
	echo 'Error connecting to server';
}

$query = $_POST['query'];
$first = $_POST['first'];
$last = $_POST['last'];

$raw_results = mysqli_query($con, "SELECT * FROM patients WHERE patientID ='$query' OR (FirstName = '$first' AND LastName = '$last')");

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
		. "Chief Complaint: " . $row["ChiefComplaint"]. "<br><br><br>";
	}
}else
{
	echo "No results found";
}
$con->close()
?>
<p><a href=patients/index.html>Go back to home page</a></p><br>
</body>
</html>