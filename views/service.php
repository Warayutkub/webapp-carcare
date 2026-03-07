<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>บริการ</title>
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
    $resultService = mysqli_query($conn, $sqlService);
    ?>
</head>

<body>
    <?php
    include '../styles/components/Navbar.php';
    // include "../styles/components/service_card.php"
    ?>

    <div class="w-full px-4 px-[20rem]">
        <div class="bg-gray-300 p-2 m-2 rounded-md w-fit flex gap-4">
            <a href="http://localhost/Carcare/main.php" class=" p-2 ">
                Dashboard
            </a>
            <a href="http://localhost/Carcare/views/queqe.php" class="p-2">
                Queqe
            </a>
            <a href="http://localhost/Carcare/views/service.php" class="p-2 rounded bg-white animate-fade-in-bg ">
                Service
            </a>
        </div>
    </div>

    <div class="bg-service px-[20rem] py-[1rem] flex ">
        <div class="service-container drop-shadow-md drop-shadow-black bg-white aspect-[16/9] w-[100rem] rounded-md p-5">
            <!-- head lable -->
            <div class="flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-icon lucide-list">
                    <path d="M3 5h.01" />
                    <path d="M3 12h.01" />
                    <path d="M3 19h.01" />
                    <path d="M8 5h13" />
                    <path d="M8 12h13" />
                    <path d="M8 19h13" />
                </svg>
                <h1>รายการบริการ</h1>
            </div>

            <!-- card -->
            <div class="grid grid-cols-2 gap-6 mt-6">
                <?php
                while ($rs = mysqli_fetch_array($resultService)) {
                ?>
                    <div class="bg-white rounded-lg border p-6 border border-grey-200 flex justify-between hover:bg-gray-300 transition-color duration-300 cursor-default">
                        <p class="text-gray-600 font-semibold text-lg"><?php echo $rs[1]  ?></p>
                        <p class="text-gray-600 font-semibold bg-gray-200 rounded p-1 px-3 flex justify-center item-center">฿<?php echo $rs[2]  ?></p>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>
    </div>
</body>

</html>