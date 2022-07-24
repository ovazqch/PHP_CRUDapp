<?php

$hostname = "localhost:3309";
$username = "phpclass";
$password = "]K.V(ym8)!-[7o]g";
$dbname = "finalproject";

$conn = new mysqli($hostname, $username, $password, $dbname);

if($conn -> connect_error){
    die("Error in connection " .$conn -> connect_error);
}

?>