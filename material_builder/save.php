<!-- <?php 
 
$koneksi = mysqli_connect("localhost","root","","web_builder");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}



// $css 	= $_POST['css'];
// $html 	= $_POST['html'];


$query = mysqli_query($koneksi,"INSERT INTO 'template' ('css', 'html') VALUES (NULL, 'test', 'test', '');");





?> -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_builder";

if (isset($_POST['html'])) {
	$css 		 =   $_POST['css'];
	// $html 	= $_POST['html'];

	$html_firts  = str_replace("'", "---?---?", $_POST['html']);
	$html  		 = str_replace('---?---?', '"', $html_firts);
}else{
	$css 	= 'Kosong';
	$html 	= 'Kosong Html';
}



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO template (css, html)
VALUES ('".$css."', '".$html."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>