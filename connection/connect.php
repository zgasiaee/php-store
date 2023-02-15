<?php

$host="localhost";
$password="";
$username="root";
$dataBase="store";
$users='users';
$tbl='products';
$tblLog="report";


$setName=array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8");

try{
    $connect=new PDO("mysql:host=$host;dbname=$dataBase;",$username,$password,$setName);
}
catch (PDOException $error){
    echo "error!";
}