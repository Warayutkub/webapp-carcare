<?php 
$id = isset($_GET['id']) ? $_GET['id'] : "";

// order orderDetail payment

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

// del orderDetail first (child table)
$sqlDelDetail = "DELETE FROM orders_detail WHERE orderId = '$id'";
$stmtDelDetail = mysqli_query($conn, $sqlDelDetail);

// del payment
$sqlDelpayment = "DELETE FROM payment WHERE orderId = '$id'";
$stmtDelpayment = mysqli_query($conn, $sqlDelpayment);

// del order last (parent table)
$sqlDelete = "DELETE FROM orders WHERE id = '$id'";
$stmtDelete = mysqli_query($conn, $sqlDelete);


if ($stmtDelete && $stmtDelDetail && $stmtDelpayment) {
    header("Location: http://localhost/Carcare/views/queqe.php");
} else {
    echo "ไม่สามารถลบข้อมูล: " . mysqli_error($conn);
}

?>