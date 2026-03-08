<?php 
$id = isset($_POST['id']) ? $_POST['id'] : "";
$name = isset($_POST['name']) ? $_POST['name'] : "";
$price = isset($_POST['price']) ? $_POST['price'] : "";

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


$sqlUpdate = "UPDATE servicetype SET servicetypeName = '$name', servicetypePrice = '$price' WHERE servicetypeId = '$id'";
$stmtUpdate = mysqli_query($conn, $sqlUpdate);

if ($stmtUpdate) {
    header("Location: http://localhost/Carcare/views/service.php");
} else {
    echo "ไม่สามารถแก้ไขข้อมูล: " . mysqli_error($conn);
}

?>