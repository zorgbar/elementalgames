<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "zorgbar";
 $dbpass = "Dotaderp2756";
 $db = "elementalgamesdb";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>