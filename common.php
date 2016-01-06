<?php
session_start();

define("WITHDRAWALS_ENABLED", true);

include('jsonRPCClient.php');
include('classes/Client.php');
include('classes/User.php');


function satoshitize($satoshitize) {
   return sprintf("%.8f", $satoshitize);
}


function satoshitrim($satoshitrim) {
   return rtrim(rtrim($satoshitrim, "0"), ".");
}

$server_url = "/";

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "piwallet";

$rpc_host = "localhost";
$rpc_port = "8332";
$rpc_user = "martexcoinrpc";
$rpc_pass = "Cp58nBkCAADKksktKSskaDKdmSQLtPJ";

$fullname = "Martexcoin";
$short = "MXT";
$blockchain_url = "http://be.martexcoin.org:2750/tx/";
$support = "suporte@martexcoin.org";
$hide_ids = array(1);
$donation_address = "M8DSVG13j3qpNDRbuuUBh5juQmSd15wLXH";
?>
