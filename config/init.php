<?php
ini_set("memory_limit", "1024M");
ini_set('max_execution_time', '1800'); //setting maximum time excecution for 30 minutes

session_start(); 
//url dasar
define('URL', 'http://localhost/penjadwalan/');
// Mengatasi error header();
ob_start();
ob_clean();
//DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'genetika3');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>