<?php
define("IN_WALLET", true);
include('common.php');
$con=mysqli_connect("$db_host","$db_user","$db_pass","$db_name");
$user = $_GET['user'];
$pass = $_GET['pass'];
$hello = mt_rand();
$newkey = sha1(md5("$pass.$user.$hello"));
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL. Make sure to edit the common.php file: " . mysqli_connect_error();
  }
$sql = "UPDATE users SET api_key='$newkey' where username = '$user' and password = '$pass'";
if ($con->query($sql) === TRUE) {
	$arraytag = array(
		'key' => "$newkey",
		'usuario' => "$user");
    //echo "Record updated successfully: $newkey";
    $json = json_encode($arraytag);
    echo "$json";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
