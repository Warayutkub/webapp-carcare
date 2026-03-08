<?php
$id = isset($_GET['id']) ? $_GET['id'] : "";

// order orderdetail payment

$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "carcare";
$conn = mysqli_connect($hostname, $username, $password);
if (!$conn) die("ไม่สามารถติดต่อ MySQL ได้");

mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล carcare ได้");

mysqli_query($conn, "set character_set_connection=utf8mb4");
mysqli_query($conn, "set character_set_client=utf8mb4");
mysqli_query($conn, "set character_set_results=utf8mb4");

$sqlSelect = "SELECT statusId FROM orders WHERE id = '$id'";
$resultSelect = mysqli_query($conn, $sqlSelect);
$row = mysqli_fetch_assoc($resultSelect);
$newStatusId = $row['statusId'] + 1;

$sqlUpdate = "UPDATE orders SET statusId = '$newStatusId' WHERE id = '$id'";
$stmtUpdate = mysqli_query($conn, $sqlUpdate);


if ($stmtUpdate) {
    header("Location: http://localhost/Carcare/views/queqe.php");
} else {
    echo "ไม่สามารถอัปเดตข้อมูล: " . mysqli_error($conn);
}
