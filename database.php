<?php
$host='localhost';
$dbname='project';
$username='root';
$password='';
$conn=mysqli_connect($host,$username,$password,$dbname);
if(!$conn)
{
die("connection failed:".mysqli_connect_error());
}

?>