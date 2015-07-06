<?php
// Includes
$absHOST = "http://fiplatform/";
require_once 'libraries/idiorm.php';

// Session. Pass your own name if you wish.
//session_name('fi_platform_session');
//session_start();

// Database configuration with the IDIORM library

$srvernme = $_SERVER['SERVER_NAME'];
if ($srvernme=='localhost') {
  $host = 'localhost';
  $user = 'root';
  $pass = 'mysqlpass123';
  $database = 'fi_platform';
} elseif ($srvernme=='filocalhost') {
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'fi_platform';
} else {
  $host = 'localhost';
  $user = 'fundinh9_showcse';
  $pass = 'WuTuL00K!ngAt';
  $database = 'fundinh9_fiplatform';
}

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $pass);

// Changing the connection to unicode
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
