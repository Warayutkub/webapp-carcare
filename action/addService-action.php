<?php

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

$sqlID = "SELECT MAX(servicetypeId) as maxId FROM servicetype";
$stmtID = mysqli_query($conn, $sqlID);
$row = mysqli_fetch_assoc($stmtID);
$idnow = ($row['maxId'] ?? 0) + 1;

$sql = "INSERT INTO servicetype (servicetypeId,servicetypeName, servicetypePrice) VALUES (?,?,?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iss", $idnow, $name, $price);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: http://localhost/Carcare/views/service.php");
} else {
    echo "Error: " . mysqli_error($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
