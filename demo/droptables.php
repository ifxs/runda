<?php


// define("DSN","mysql:host=qdm114391305.my3w.com;dbname=qdm114391305_db");
// define("USER","qdm114391305");
// define("PASSWORD","runda2015");

$hostname ='qdm114391305.my3w.com';  
$userid = 'qdm114391305';  
$password = 'runda2015';  
$dbname = 'qdm114391305_db';  
$connect = mysql_connect($hostname,$userid,$password);  
mysql_select_db($dbname);  
$result = mysql_query("show table status from $dbname",$connect);  
while($data=mysql_fetch_array($result)) {  
    mysql_query("drop table $data[Name]");  
} 