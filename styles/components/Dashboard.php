<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "carcare";
$conn = mysqli_connect($hostname, $username, $password);
if (!$conn)
    die("ไม่สามารถติดต่อกับ MySQL ได้");
mysqli_select_db($conn, $dbName) or die("ไม่สามารถเลือกฐานข้อมูล carcare ได้");
mysqli_query($conn, "set character_set_connection=utf8mb4");
mysqli_query($conn, "set character_set_client=utf8mb4");
mysqli_query($conn, "set character_set_results=utf8mb4");
$sqlQueue = "SELECT COUNT(*) as total FROM orders WHERE statusId = 1";
$sqlFinish = "SELECT COUNT(*) as total FROM orders WHERE statusId = 4";
$sqlAmount = "SELECT SUM(amount) as totalAmount FROM payment";

$queue = mysqli_fetch_assoc(mysqli_query($conn,$sqlQueue));
$finish = mysqli_fetch_assoc(mysqli_query($conn,$sqlFinish));
$totalAmount = mysqli_fetch_assoc(mysqli_query($conn, $sqlAmount));

    ?>

<div class="bgDashboard">
    <div class="firstBar">
        <div class="firstBar-Layout">
            <p>รายได้</p>
            <?php
            echo "<p>" . number_format($totalAmount['totalAmount']) . " บาท</p>";
            ?>
        </div>
        <div class="firstBar-Layout">
            <p>รถในคิว</p>
            <?php
            echo "<p>" . $queue['total'] . "</p>";
            ?>
        </div>
        <div class="firstBar-Layout">
            <p>เสร้จแล้ว</p>
            <?php
            echo "<p>" . $finish['total'] . "</p>";
            ?>
        </div>
    </div>
</div>