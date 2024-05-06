<?php 

DEFINE ('DB_USER', 'root'); // change this depending on the db_user 
DEFINE ('DB_PASSWORD', ''); // change this depending on the db_password
DEFINE ('DB_HOST', 'localhost');

//DEFINE ('DB_NAME', 'candela_database');
DEFINE ('DB_NAME', 'if0_36490342_candela_db');

$mysqli = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
            or die("Unable To Connect: " . mysqli_connect_error());

mysqli_set_charset($mysqli, 'utf8');


// start the session immediately
session_start();
?>
