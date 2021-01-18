<?php
$dbuser="root";
$dbhost="localhost";
$dbpass="";
$dbname="cms";
$conn=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if($conn->connect_error){
 echo 'failed to connect';
}
// else{
//  echo "connected";
// }
