<?php 
$GLOBALS['conn'] = mysqli_connect("localhost","root","password","request_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //Connecting to Redis server on localhost 
$redis = new Redis(); 
$redis->connect('127.0.0.1', 6379); 
echo "" .$redis->ping();

echo "Connection to server sucessfully"; 
?>