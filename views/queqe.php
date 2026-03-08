<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../styles/main.css">
    <title>คิวทั้งหมด</title>
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

    // service
    $sqlService = "select * from servicetype";
    $resultService = mysqli_query($conn, $sqlService);

    // order
    $sqlOrder = "select * from orders";
    $resultOrder = mysqli_query($conn, $sqlOrder);

    // order detail
    $sqlOrderD = "select * from orders_detail";
    $resultOrderD = mysqli_query($conn, $sqlOrderD);

    // csutomer
    $sqlCustomer = "select * from customer";
    $resultCustomer = mysqli_query($conn, $sqlCustomer);

    // payment
    $sqlPayment = "select * from payment";
    $resultPayment = mysqli_query($conn, $sqlPayment);

    // status - assuming you have a status table or get status from orders table
    $sqlStatus = "select * from status"; // Change this to your actual status table name
    $resultStatus = mysqli_query($conn, $sqlStatus);

    // Create status lookup array
    $statusLookup = array();
    while ($status = mysqli_fetch_array($resultStatus)) {
        $statusLookup[$status[0]] = $status[1]; // assuming status[0] = id, status[1] = name
    }

    // Payment lookup array
    $paymentLookup = array();
    while ($payment = mysqli_fetch_array($resultPayment)) {
        $paymentLookup[$payment[1]] = $payment[2]; // payment[1] = order_id, payment[2] = payment_data
    }

    // Service lookup array
    $serviceLookup = array();
    while ($serviceType = mysqli_fetch_array($resultService)) {
        $serviceLookup[$serviceType[0]] = $serviceType[1]; // service[0] = id, service[1] = name
    }

    // Order details lookup array (for getting services by order)
    $orderServices = array();
    while ($orderDetail = mysqli_fetch_array($resultOrderD)) {
        if (!isset($orderServices[$orderDetail[2]])) {
            $orderServices[$orderDetail[2]] = array();
        }
        $orderServices[$orderDetail[2]][] = $orderDetail[1];
    }
    ?>
</head>

<body>
    <?php
    include '../styles/components/Navbar.php';
    ?>

    <div class="w-full px-4 px-[20rem]">
        <div class="bg-gray-300 p-2 m-2 rounded-md w-fit flex gap-4">
            <a href="http://localhost/Carcare/views/queqe.php" class="p-2 rounded bg-white animate-fade-in-bg ">
                Queqe
            </a>
            <a href="http://localhost/Carcare/views/service.php" class="p-2 ">
                Service
            </a>
        </div>
    </div>

    <?php
    include '../styles/components/Dashboard.php';
    ?>


    <!-- main -->
    <div class="bg-service px-[10rem] py-[1rem] flex ">
        <div class="service-container  aspect-[16/9] w-[100rem] rounded-md p-5 grid grid-cols-4 gap-4">
            <!-- รอ -->
            <div>
                <h3 class="text-center font-bold mb-4 text-gray-700 bg-blue-500 p-4 rounded-md text-white ">รอคิว</h3>
                <?php
                mysqli_data_seek($resultOrder, 0); // Reset pointer
                while ($order = mysqli_fetch_array($resultOrder)) {
                    $currentStatus = isset($statusLookup[$order[6]]) ? $statusLookup[$order[6]] : null;

                    if ($currentStatus !== null && $currentStatus == "รอคิว") {
                ?>
                        <!-- Car Queue Card -->
                        <div class="bg-white rounded-lg shadow-md p-4 max-w-sm mb-4">
                            <!-- Car Number -->
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                        <path d="M3 4a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 14.846 4.632 16.5 6.414 16.5H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                                    </svg>
                                    <span class="text-lg font-bold text-gray-800"><?php echo $order[7] ?></span>
                                </div>
                                <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-xs font-medium">
                                    <?php echo $currentStatus;
                                    ?>
                                </span>
                            </div>

                            <!-- Car Model -->
                            <h3 class="text-gray-800 font-medium mb-2">
                                <?php echo isset($order[3]) ? $order[3] : "no car model data" ?>
                            </h3>

                            <!-- Service -->
                            <div class="text-blue-600 text-sm mb-3">
                                <?php
                                if (isset($orderServices[$order[0]])) {
                                    foreach ($orderServices[$order[0]] as $serviceId) {
                                        if (isset($serviceLookup[$serviceId])) {
                                            echo '<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">' . $serviceLookup[$serviceId] . '</span>';
                                        }
                                    }
                                } else {
                                    echo '<span class="text-gray-500">No services</span>';
                                }
                                ?>
                            </div>

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-bold text-gray-900">
                                    ฿<?php echo isset($paymentLookup[$order[0]]) ? $paymentLookup[$order[0]] : 'No Payment Data'; ?>
                                </span>
                            </div>

                            <!-- Phone Number -->
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span class="text-gray-600 text-sm">091-234-5678</span>
                            </div>

                            <!-- Action Button -->
                            <div class="flex gap-2">
                                <button class="w-full bg-red-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center justify-center gap-2"
                                    onclick="if(confirm('ต้องการลบหรือไม่?')) { window.location.href='../action/delete-queqe.php?id=<?php echo $order[0]; ?>'; }">
                                    ยกเลิก x
                                </button>
                                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center justify-center gap-2"
                                    onclick="if(confirm('ไปขั้นตอนต่อไป?')) { window.location.href='../action/nextStatus-queqe.php?id=<?php echo $order[0]; ?>'; }">
                                    ต่อไป
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                <?php
                    }
                } ?>

            </div>
            <!-- กำลังทำ -->
            <div>
                <h3 class="text-center font-bold mb-4 text-gray-700 bg-green-500 p-4 rounded-md text-white">กำลังทำ</h3>
                <?php
                mysqli_data_seek($resultOrder, 0); // Reset pointer
                while ($order = mysqli_fetch_array($resultOrder)) {
                    $currentStatus = isset($statusLookup[$order[6]]) ? $statusLookup[$order[6]] : null;
                    if ($currentStatus !== null && $currentStatus == "กำลังดำเนินการ") {
                ?>
                        <!-- Car Queue Card -->
                        <div class="bg-white rounded-lg shadow-md p-4 max-w-sm mb-4">
                            <!-- Car Number -->
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                        <path d="M3 4a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 14.846 4.632 16.5 6.414 16.5H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                                    </svg>
                                    <span class="text-lg font-bold text-gray-800"><?php echo $order[7] ?></span>
                                </div>
                                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs font-medium">
                                    <?php echo $currentStatus; ?>
                                </span>
                            </div>

                            <!-- Car Model -->
                            <h3 class="text-gray-800 font-medium mb-2">
                                <?php echo isset($order[3]) ? $order[3] : "no car model data" ?>
                            </h3>

                            <!-- Service -->
                            <div class="text-blue-600 text-sm mb-3">
                                <?php
                                if (isset($orderServices[$order[0]])) {
                                    foreach ($orderServices[$order[0]] as $serviceId) {
                                        if (isset($serviceLookup[$serviceId])) {
                                            echo '<span class="inline-block bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded mr-1 mb-1">' . $serviceLookup[$serviceId] . '</span>';
                                        }
                                    }
                                } else {
                                    echo '<span class="text-gray-500">No services</span>';
                                }
                                ?>
                            </div>

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-bold text-gray-900">
                                    ฿<?php echo isset($paymentLookup[$order[0]]) ? $paymentLookup[$order[0]] : 'No Payment Data'; ?>
                                </span>
                            </div>

                            <!-- Phone Number -->
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span class="text-gray-600 text-sm">091-234-5678</span>
                            </div>

                            <!-- Action Button -->
                            <div class="flex gap-2">
                                <button class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center justify-center gap-2"
                                    onclick="if(confirm('ต้องการลบหรือไม่?')) { window.location.href='../action/delete-queqe.php?id=<?php echo $order[0]; ?>'; }">
                                    ยกเลิก x
                                </button>
                                <button class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center justify-center gap-2"
                                    onclick="if(confirm('ไปขั้นตอนต่อไป?')) { window.location.href='../action/nextStatus-queqe.php?id=<?php echo $order[0]; ?>'; }">
                                    กำลังทำงาน
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
            <!-- รอรับรถ -->
            <div>
                <h3 class="text-center font-bold mb-4 text-gray-700 bg-yellow-500 p-4 rounded-md text-white">รอรับรถ</h3>
                <?php
                mysqli_data_seek($resultOrder, 0); // Reset pointer
                while ($order = mysqli_fetch_array($resultOrder)) {
                    $currentStatus = isset($statusLookup[$order[6]]) ? $statusLookup[$order[6]] : null;

                    if ($currentStatus !== null && $currentStatus == "รอรับรถ") {
                ?>
                        <!-- Car Queue Card -->
                        <div class="bg-white rounded-lg shadow-md p-4 max-w-sm mb-4">
                            <!-- Car Number -->
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                        <path d="M3 4a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 14.846 4.632 16.5 6.414 16.5H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                                    </svg>
                                    <span class="text-lg font-bold text-gray-800"><?php echo $order[7] ?></span>
                                </div>
                                <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs font-medium">
                                    <?php echo $currentStatus; ?>
                                </span>
                            </div>

                            <!-- Car Model -->
                            <h3 class="text-gray-800 font-medium mb-2">
                                <?php echo isset($order[3]) ? $order[3] : "no car model data" ?>
                            </h3>

                            <!-- Service -->
                            <div class="text-blue-600 text-sm mb-3">
                                <?php
                                if (isset($orderServices[$order[0]])) {
                                    foreach ($orderServices[$order[0]] as $serviceId) {
                                        if (isset($serviceLookup[$serviceId])) {
                                            echo '<span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mr-1 mb-1">' . $serviceLookup[$serviceId] . '</span>';
                                        }
                                    }
                                } else {
                                    echo '<span class="text-gray-500">No services</span>';
                                }
                                ?>
                            </div>

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-bold text-gray-900">
                                    ฿<?php echo isset($paymentLookup[$order[0]]) ? $paymentLookup[$order[0]] : 'No Payment Data'; ?>
                                </span>
                            </div>

                            <!-- Phone Number -->
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span class="text-gray-600 text-sm">091-234-5678</span>
                            </div>

                            <!-- Action Button -->
                            <div class="flex gap-2">
                                <button class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center justify-center gap-2"
                                    onclick="if(confirm('ต้องการลบหรือไม่?')) { window.location.href='../action/delete-queqe.php?id=<?php echo $order[0]; ?>'; }">
                                    ยกเลิก x
                                </button>
                                <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center justify-center gap-2"
                                    onclick="if(confirm('ไปขั้นตอนต่อไป?')) { window.location.href='../action/nextStatus-queqe.php?id=<?php echo $order[0]; ?>'; }">
                                    พร้อมรับรถ
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
            <!-- เสร็จสิ้น -->
            <div>
                <h3 class="text-center font-bold mb-4 text-gray-700 bg-green-600 p-4 rounded-md text-white">เสร็จสิ้น</h3>
                <?php
                mysqli_data_seek($resultOrder, 0); // Reset pointer
                while ($order = mysqli_fetch_array($resultOrder)) {
                    $currentStatus = isset($statusLookup[$order[6]]) ? $statusLookup[$order[6]] : null;

                    if ($currentStatus !== null && $currentStatus == "เสร็จสิ้น") {
                ?>
                        <!-- Car Queue Card -->
                        <div class="bg-white rounded-lg shadow-md p-4 max-w-sm mb-4">
                            <!-- Car Number -->
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                        <path d="M3 4a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 14.846 4.632 16.5 6.414 16.5H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                                    </svg>
                                    <span class="text-lg font-bold text-gray-800"><?php echo $order[7] ?></span>
                                </div>
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-medium">
                                    <?php echo $currentStatus; ?>
                                </span>
                            </div>

                            <!-- Car Model -->
                            <h3 class="text-gray-800 font-medium mb-2">
                                <?php echo isset($order[3]) ? $order[3] : "no car model data" ?>
                            </h3>

                            <!-- Service -->
                            <div class="text-blue-600 text-sm mb-3">
                                <?php
                                if (isset($orderServices[$order[0]])) {
                                    foreach ($orderServices[$order[0]] as $serviceId) {
                                        if (isset($serviceLookup[$serviceId])) {
                                            echo '<span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded mr-1 mb-1">' . $serviceLookup[$serviceId] . '</span>';
                                        }
                                    }
                                } else {
                                    echo '<span class="text-gray-500">No services</span>';
                                }
                                ?>
                            </div>

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-bold text-gray-900">
                                    ฿<?php echo isset($paymentLookup[$order[0]]) ? $paymentLookup[$order[0]] : 'No Payment Data'; ?>
                                </span>
                            </div>

                            <!-- Phone Number -->
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span class="text-gray-600 text-sm">091-234-5678</span>
                            </div>

                            <!-- Action Button -->
                            <button class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center justify-center gap-2"
                                >
                                เสร็จสิ้น
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </div>
    </div>
</body>

</html>