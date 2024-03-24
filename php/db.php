<?php
$servername="localhost";
$username="root";
$password="";
$dbname="bot";

$conn=new mysqli($servername,$username,$password,$dbname);
if($conn){
      //echo("connected");
}else{
    echo("not connected");
}

