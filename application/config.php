<?php

//Database Connection Info
$HOSTNAME = "localhost";
$DATABASE = "gtrdskmx";
$USERNAME = "gtrdskmx_ro";
$PASSWORD = "lK6WVXrz1_K94ruS7glz";

$msqli_error = false;
$mysqli = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
if (mysqli_connect_errno($mysqli)) {
    $msqli_error = mysqli_connect_error();
}

//location to store files, should not be under the webroot
$FILE_LOCATION = __DIR__."/../uploads/";

function create_code(){
	//TODO - don't generate duplicates.
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>
