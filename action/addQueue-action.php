<?php
$method = $_POST['methodList']??[];
$carPlate = $_POST['carPlate'];
$carType = $_POST['carType'];
$modelCar = $_POST['modelCar'];
$serviceList = $_POST['serviceList'] ?? [];
$name = $_POST['name'];
$surname = $_POST['surname'];
$number = $_POST['number'];

$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "carcare";

$conn = mysqli_connect($hostname,$username,$password);
if(!$conn) die("ไม่สามารถติดต่อ MySQL ได้");

mysqli_select_db($conn,$dbName) or die("ไม่สามารถเลือกฐานข้อมูล carcare ได้");

mysqli_query($conn,"set character_set_connection=utf8mb4");
mysqli_query($conn,"set character_set_client=utf8mb4");
mysqli_query($conn,"set character_set_results=utf8mb4");


/* เพิ่ม customer */

$sqlCustomer = "INSERT INTO customer(customerName,customerSurname,customerPhone)
VALUES('$name','$surname','$number')";
mysqli_query($conn,$sqlCustomer);

$customerId = mysqli_insert_id($conn);


/* เลือก employee คนแรก */
$sqlEmployeeAll = "SELECT * FROM employee LIMIT 1";
$employeeResult = mysqli_fetch_array(mysqli_query($conn,$sqlEmployeeAll));
$employeeId = $employeeResult['id'];

// เลือก status id
$sqlStatusAll = "SELECT * FROM status";
$statusResult = mysqli_fetch_array(mysqli_query($conn,$sqlStatusAll));
$statusId = $statusResult['id'];

/* เพิ่ม orders */

$sqlOrder = "INSERT INTO orders(customerId,carType,modelCar,orderDate,employeeId,statusId,license_plate)
VALUES('$customerId','$carType','$modelCar',CURDATE(),'$employeeId','$statusId','$carPlate')";
mysqli_query($conn,$sqlOrder);

$orderId = mysqli_insert_id($conn);


/* เพิ่ม service หลายรายการ */    
foreach($serviceList as $service){
    
    $sqlDetail = "INSERT INTO orders_detail(serviceTypeid,orderId)
                  VALUES('$service','$orderId')";

mysqli_query($conn,$sqlDetail);
}

//cal amount
$ids = $serviceList;
$idList = implode(",", $ids);

$calamountSql = "SELECT servicetypePrice FROM servicetype WHERE servicetypeId IN ($idList)";
$resultAmount = mysqli_query($conn,$calamountSql);
$totalAmount = 0;

while($row = mysqli_fetch_assoc($resultAmount)){
    $totalAmount += $row['servicetypePrice'];
}

//insert payment
foreach($method as $payment){
    $sqlPayment = "INSERT INTO payment(orderId,amount,payMethod,payDate) VALUES ('$orderId','$totalAmount','$payment',CURDATE())";
    mysqli_query($conn,$sqlPayment);
}

header("Location: http://localhost/Carcare/views/queqe.php");
?>