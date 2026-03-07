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
$sqlService = "select * from servicetype";
$sqlTypecar = "select * from type_car";
$sqlPaymentMethod = "select * from payment_method";
$resultService = mysqli_query($conn, $sqlService);
$resultTypecar = mysqli_query($conn, $sqlTypecar);
$resultPaymentMethod = mysqli_query($conn, $sqlPaymentMethod);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/fluk.css">
    <title>เพิ่มคิว</title>
</head>

<body>
    <div class="bgForm">
        <form action="action/addQueue-action.php" class="formQueue" method="POST">
            <a href="http://localhost/Carcare/main.php" class="exitX">X</a>
            <h2 align="center" style="font-size:40px;">เพิ่มรถเข้าคิว</h2>
            <p>ป้ายทะเบียน</p>
            <input type="text" name="carPlate" placeholder=" กข 1234" style="border: 1px solid black; border-radius: 5px;">
            <p>ประเภทรถ</p>
            <select name='carType' id='carType' style="border: 1px solid black; border-radius: 5px;">
                <?php
                while ($rs = mysqli_fetch_array($resultTypecar)) {
                    echo "<option value='$rs[0]'>$rs[1]</option>";
                }
                ?>
            </select>
            <p>รุ่นรถ</p>
            <input type="text" name="modelCar" placeholder=" เวฟ 650" style="border: 1px solid black; border-radius: 5px;">
            <p>บริการ</p>
            <div class="serviceSelect">
                <?php
                while ($rs = mysqli_fetch_array($resultService)) {
                    echo "<div class='checkBox'>";
                    echo "<input type='checkbox' name='serviceList[]' value='$rs[0]'>" . $rs[1] . "<br>";
                    echo "<p style='opacity:50%;'>" . $rs[2] . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
            <div class="nameSurname">
                <p>ชื่อ</p>
                <p>นามสกุล</p>
                <input type="text" name="name" id="name" placeholder=" สมชาย"
                    style="border: 1px solid black; border-radius: 5px;">
                <input type="text" name="surname" id="surname" placeholder=" ลายรัก"
                    style="border: 1px solid black; border-radius: 5px;">
            </div>
            <p>เบอร์โทรศัพท์ลูกค้า</p><input type="number" name="number" id="number" placeholder=" 094xxxxxxx"
                style="border: 1px solid black; border-radius: 5px;">
            <div class="serviceSelect">
                <?php
                while ($rs = mysqli_fetch_array($resultPaymentMethod)) {
                    echo "<div class='checkBox'>";
                    echo "<input type='checkbox' name='methodList[]' value='$rs[0]'>" . $rs[1];
                    echo "</div>";
                }
                ?>
            </div>
            <button type="submit" class="ButtonForm">เพิ่มคิว</button>
        </form>
    </div>
</body>

</html>

<?php

?>