<?php
$carPlate = $_POST['carPlate'];
$carType = $_POST['carType'];
$serviceList = $_POST['serviceList'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$number = $_POST['number'];
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "carcare";
$conn = mysqli_connect($hostname,$username,$password);
if(!$conn) die("ไม่สามารถเลือกฐานข้อมูล MySQL ได้");
mysqli_select_db($conn,$dbName) or die("ไม่สามารถเลือกฐานข้อมูล carcare ได้");
mysqli_query($conn,"set character_set_connection = utf8mb4");
mysqli_query($conn,"set character_set_client = utf8mb4");
mysqli_query($conn,"set character_set_results = utf8mb4");
$sqlCustomer = "insert into customer(customerName,customerSurname,customerPhone) values ('$name','$surname','$number')";
$sqlOrder = "insert into orders(modelCar) values ('$carType')";
mysqli_query($conn,$sqlCustomer);
mysqli_query($conn,$sqlOrder);
?>