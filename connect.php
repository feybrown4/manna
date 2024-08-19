<?php

//start session
session_start();

define('SITEURL', 'http://localhost/manna');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define ('DB_NAME', 'manna');
//define('DB_NAME', 'bitternkemowhuo');
//define('DB_NAME', 'productsdemo');

global $con;
	  $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
?>