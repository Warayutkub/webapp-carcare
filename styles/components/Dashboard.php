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
$sqlQueue = "SELECT COUNT(*) as total FROM orders WHERE statusId in (1,2,3)";
$sqlFinish = "SELECT COUNT(*) as total FROM orders WHERE statusId = 4";
$sqlAmount = "SELECT SUM(amount) as totalAmount FROM payment";

$queue = mysqli_fetch_assoc(mysqli_query($conn, $sqlQueue));
$finish = mysqli_fetch_assoc(mysqli_query($conn, $sqlFinish));
$totalAmount = mysqli_fetch_assoc(mysqli_query($conn, $sqlAmount));

?>

<div class="flex justify-center items-center gap-[10rem]  mt-10">
    <div class="w-[10rem] bg-sky-300 shadow-md border p-4 flex flex-col gap-2 justify-center items-center rounded-md self-center ">

        <p class="font-bold text-lg"> <?php echo number_format($totalAmount['totalAmount']) ?> บาท </p>
        <p>รายได้ทั้งหมด</p>
    </div>
    <div class="w-[10rem] bg-sky-300 shadow-md border p-4 flex flex-col gap-2 justify-center items-center rounded-md self-center ">
        <p class="font-bold text-lg"> <?php echo  $queue['total']  ?> </p>
        <p>รถในคิว</p>
    </div>
    <div class="w-[10rem] bg-sky-300 shadow-md border p-4 flex flex-col gap-2 justify-center items-center rounded-md self-center ">
        <p class="font-bold text-lg"> <?php echo  $finish['total'] ?> </p>
        <p>เสร็จสิ้น</p>
    </div>
</div>