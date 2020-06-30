<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$database = "bulma_cms";

$db = new mysqli($host, $user, $pass, $database);
if ($db->connect_errno) {
    echo $db->connect_error;
    die();
}