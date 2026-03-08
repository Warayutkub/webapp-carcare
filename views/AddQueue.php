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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>เพิ่มคิว</title>
</head>

<body>
    <div class="bgForm">
        <form action="../action/addQueue-action.php" class="bg-white border p-10 my-10 rounded-[30px] relative drop-shadow-md drop-shadow-black flex flex-col space-y-4" method="POST">
            <a href="http://localhost/Carcare/main.php" class="absolute top-6 right-8">X</a>
            <h2 align="center" style="font-size:40px;">เพิ่มรถเข้าคิว</h2>
            <div class="flex flex-row gap-2 items-center">
                <p class="font-bold">ป้ายทะเบียน</p>
                <input type="text" name="carPlate" placeholder=" กข 1234" class="border shadow-md p-1" >
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col gap-2 m-0 p-0">
                    <p class="font-bold">ประเภทรถ</p>
                    <select name='carType' id='carType' class="p-2 border shadow-md">
                        <?php
                        while ($rs = mysqli_fetch_array($resultTypecar)) {
                            echo "<option value='$rs[0]'>$rs[1]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="flex flex-col gap-2 m-0 p-0">
                    <p class="font-bold">รุ่นรถ</p>
                    <input type="text" name="modelCar" placeholder=" เวฟ 650" class="p-2 border shadow-md">
                </div>
            </div>
            <p class="font-bold">บริการ</p>
            <div class="grid grid-cols-2 gap-4">
                <?php
                while ($rs = mysqli_fetch_array($resultService)) { ?>
                    <div class="bg-white rounded-sm shadow-md hover:shadow-md transition flex flex-row gap-2 border border-gray-200 p-4 justify-between">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type='checkbox' name='serviceList[]' value='<?php echo $rs[0] ?>' class="w-4 h-4 accent-blue-500">
                            <span class="font-medium"><?php echo $rs[1] ?></span>
                        </label>
                        <p class="text-sm text-gray-500"><?php echo "฿" . $rs[2] ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <p>ชื่อ</p>
                <p>นามสกุล</p>
                <input type="text" name="name" id="name" placeholder=" สมชาย"
                    style="border: 1px solid black; border-radius: 5px;" class="p-2">
                <input type="text" name="surname" id="surname" placeholder=" ลายรัก" class="p-2"
                    style="border: 1px solid black; border-radius: 5px;">
            </div>
            <div class="flex flex-col">
                <p class="font-bold">เบอร์โทรศัพท์ลูกค้า</p>
                <input type="number" name="number" id="number" placeholder=" 094xxxxxxx" class="p-2"
                    style="border: 1px solid black; border-radius: 5px;">
            </div>
            <div class="grid grid-cols-2 gap-2 w-[40rem] ">
                <?php
                while ($rs = mysqli_fetch_array($resultPaymentMethod)) { ?>
                    <div class="rounded-md bg-white border shadow-sm p-2 flex gap-6 px-6">
                        <input type='checkbox' name='methodList[]' value='<?php echo $rs[0] ?>'> <?php echo $rs[1] ?>
                    </div>
                <?php }
                ?>
            </div>
            <button type="submit" class="ButtonForm">เพิ่มคิว</button>
        </form>
    </div>
</body>

</html>

<?php

?>