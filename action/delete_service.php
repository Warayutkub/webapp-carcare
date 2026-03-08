<?php 
$id = isset($_GET['id']) ? $_GET['id'] : "";

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

$sqlDelete = "DELETE FROM servicetype WHERE servicetypeId = '$id'";
$stmtDelete = mysqli_query($conn, $sqlDelete);

if ($stmtDelete) {
    header("Location: http://localhost/Carcare/views/service.php");
} else {
    echo "ไม่สามารถลบข้อมูล: " . mysqli_error($conn);
}

?>