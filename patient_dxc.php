<html>
	<head>
		<title> Patient DxC Submission </title>
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
		. "Chief Complaint: " . $row["ChiefComplaint"]. "<br><br>";
	}
}else
{
	echo "No results found";
}
?>

<h2>Working Diagnosis</h2>
<form action="/patient_dxc_return.php" method="post">
<h4>HEENT</h4>
<input type="checkbox" name="HEENT[]" value="Conjunctivitis"> Conjunctivitis <input type="checkbox" name="HEENT[]" value="Otitis"> Otitis <input type="checkbox" name="HEENT[]" value="Sinusitis"> Sinusitis <input type="checkbox" name="HEENT[]" value="Allergies"> Allergies <input type="checkbox" name="OtherHEENT" value="OtherHEENT"> Other <input type="text" name="OtherHEENTEntry"><br>
<h4>Lung</h4>
<input type="checkbox" name="Lung[]" value="Respiratory Infection"> Respiratory Infection <input type="checkbox" name="Lung[]" value="Asthma"> Asthma <input type="checkbox" name="Lung[]" value="COPD"> COPD <input type="checkbox" name="Lung[]" value="TB"> TB <input type="checkbox" name="OtherLung" value="OtherLung"> Other <input type="text" name="OtherLungEntry">
<h4>CV</h4>
<input type="checkbox" name="CV[]" value="HTN"> HTN <input type="checkbox" name="CV[]" value="CAD"> CAD <input type="checkbox" name="CV[]" value="Arrhythmia"> Arrhythmia <input type="checkbox" name="CV[]" value="Congenital"> Congenital <input type="checkbox" name="OtherCV" value="OtherCV"> Other <input type="text" name="OtherCVEntry">
<h4>GI</h4>
<input type="checkbox" name="GI[]" value="GERD"> GERD <input type="checkbox" name="GI[]" value="Gastritis/PUD"> Gastritis/PUD <input type="checkbox" name="GI[]" value="Gastroenteritis"> Gastroenteritis <input type="checkbox" name="OtherGI" value="OtherGI"> Other <input type="text" name="OtherGIEntry">
<h4>GU</h4>
<input type="checkbox" name="GU[]" value="UTI"> UTI <input type="checkbox" name="GU[]" value="Kidney Stone"> Kidney Stone <input type="checkbox" name="GU[]" value="Hernia"> Hernia <input type="checkbox" name="OtherGU" value="OtherGU"> Other <input type="text" name="OtherGUEntry">
<h4>Neuro</h4>
<input type="checkbox" name="Neuro[]" value="HA"> HA <input type="checkbox" name="Neuro[]" value="CVA"> CVA <input type="checkbox" name="Neuro[]" value="Seizure"> Seizure <input type="checkbox" name="OtherNeuro" value="OtherNeuro"> Other <input type="text" name="OtherNeuroEntry">
<h4>MSK</h4>
<input type="checkbox" name="MSK[]" value="Gout"> Gout <input type="checkbox" name="MSK[]" value="Arthritis"> Arthritis <input type="checkbox" name="OtherMSK" value="OtherMSK"> Other MSK <input type="text" name="OtherMSKEntry">
<h4>Endocrine</h4>
<input type="checkbox" name="Endocrine[]" value="Goiter"> Goiter <input type="checkbox" name="Endocrine[]" value="Hypothyroid"> Hypothyroid <input type="checkbox" name="Endocrine[]" value="DM"> DM <input type="checkbox" name="OtherEndocrine" value="OtherEndocrine"> Other <input type="text" name="OtherEndocrineEntry">
<h4>Skin</h4>
<input type="checkbox" name="Skin[]" value="Eczema"> Eczema <input type="checkbox" name="Skin[]" value="Skin Infection"> Skin Infection <input type="checkbox" name="OtherSkin" value="OtherSkin"> Other rash/skin <input type="text" name="OtherSkinEntry">
<h4>OB-Gyn</h4>
<input type="checkbox" name="OGGyn[]" value="Menstrual abnormality"> Menstrual abnormality <input type="checkbox" name="OGGyn[]" value="Pregnancy"> Pregnancy <input type="checkbox" name="OGGyn[]" value="Breast Mass"> Breast Mass <input type="checkbox" name="OtherOGGyn" value="OtherOGGyn"> Other <input type="text" name="OtherOGGynEntry">
<h4>Heme</h4>
<input type="checkbox" name="Heme[]" value="Anemia"> Anemia <input type="checkbox" name="OtherHeme" value="OtherHeme"> Other <input type="text" name="OtherHemeEntry">
<h4>Psych</h4>
<input type="checkbox" name="Psych[]" value="Depression"> Depression <input type="checkbox" name="Psych[]" value="Anxiety"> Anxiety <input type="checkbox" name="Psych[]" value="Insomnia"> Insomnia <input type="checkbox" name="OtherPsych" value="OtherPsych"> Other <input type="text" name="OtherPsychEntry"><br>

<input type="hidden" name="query" value="<?php echo "$id";?>"/><br><br>
Submitted By: <input type="text" name="author"> <br>
<input type="submit" name="submit" value="Submit" required>
</form>
</body>
</html>