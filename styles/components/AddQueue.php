<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "carcare";
$conn = mysqli_connect($hostname,$username,$password);
if(!$conn) die("ไม่สามารถติดต่อกับ MySQL ได้");
mysqli_select_db($conn,$dbName) or die("ไม่สามารถเลือกฐานข้อมูล carcare ได้");
mysqli_query($conn,"set character_set_connection=utf8mb4");
mysqli_query($conn,"set character_set_client=utf8mb4");
mysqli_query($conn,"set character_set_results=utf8mb4");
$sqlService = "select * from servicetype";
$sqlTypecar = "select * from type_car";
$resultService = mysqli_query($conn,$sqlService);
$resultTypecar = mysqli_query($conn,$sqlTypecar);
?>

<div class="bgForm">
    <form action="action/addQueue-action.php" class="formQueue" method="POST">
        <button class="exitX">X</button>
        <h2 align="center" style="font-size:40px;">เพิ่มรถเข้าคิว</h2>
        <p>ป้ายทะเบียน</p>
        <input type="text" name="carPlate" placeholder=" กข 1234" style="border: 1px solid black; border-radius: 5px;">
        <p>ประเภทรถ</p>
        <select name='carType' id='carType' style="border: 1px solid black; border-radius: 5px;">
        <?php
        while ($rs = mysqli_fetch_array($resultTypecar)) {
            echo"<option value='$rs[0]'>$rs[1]</option>";
            }
            ?>
        </select>
        <p>บริการ</p>
        <div class="serviceSelect">
                <?php 
                while($rs = mysqli_fetch_array($resultService)){
                    echo "<div class='checkBox'>";
                    echo "<input type='checkbox' name='serviceList'>".$rs[1]."<br>";
                    echo "<p style='opacity:50%;'>".$rs[2]."</p>";
                    echo "</div>";
                };
                ?>
        </div>
        <div class="nameSurname">
            <p>ชื่อ</p>
            <p>นามสกุล</p>
            <input type="text" name="name" id="name" placeholder=" สมชาย" style="border: 1px solid black; border-radius: 5px;">
            <input type="text" name="surname" id="surname" placeholder=" ลายรัก" style="border: 1px solid black; border-radius: 5px;">
        </div>
        <p>เบอร์โทรศัพท์ลูกค้า</p><input type="number" name="number" id="number" placeholder=" 094xxxxxxx" style="border: 1px solid black; border-radius: 5px;">
        <br>
        <button type="submit" class="ButtonForm">เพิ่มคิว</button>
    </form>
</div>

<?php

?>