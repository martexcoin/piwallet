<?php
define("IN_WALLET", true);
include('common.php');
$con=mysqli_connect("$db_host","$db_user","$db_pass","$db_name");
$key = $_GET['key'];
$foraddress = $_GET['toaddress'];
$amounttosent = $_GET['amounttosent'];
$hello = mt_rand();
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL. Make sure to edit the common.php file: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT * FROM users where api_key = '$key'");
while($row = mysqli_fetch_array($result))
{
$id = $row['id'];
$username = $row['username'];
if ($username != true) {
	echo "Erro De Key / Key Invalida";
}else{

$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
$balanceaccont = $client->getBalance($username);

if (!WITHDRAWALS_ENABLED) {
	$error['type'] = "withdraw";
	$error['message'] = "Saques estão temporariamente inativos...";
} elseif (empty($foraddress) || empty($amounttosent) || !is_numeric($amounttosent)) {
	$error['type'] = "withdraw";
	$error['message'] = "Preencha todos os campos.";
} elseif ($amounttosent > $balanceaccont) {
	$error['type'] = "withdraw";
	$error['message'] = "O valor de saque excede seu saldo.";
} else {
	$apibal = $client->withdraw($username, $foraddress, (float)$amounttosent);
}

}

echo json_encode(array("id" => "$id", "username" => "$username", "For Address" => "$foraddress", "Amount Send" => "$amounttosent", "TXID" => "$apibal"));



$newkey = sha1(md5("$id.$username.$hello"));
$sql = "UPDATE users SET api_key='$newkey' where api_key = '$key'";
if ($con->query($sql) === TRUE) {
	echo "Key Trocada Automaticamente";
} else {
    echo "Error updating record: " . $conn->error;
}}
?>
