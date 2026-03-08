<?php
// Get service ID from URL parameter
$serviceId = isset($_GET['id']) ? $_GET['id'] : null;
$serviceData = null;

if ($serviceId) {
    // Fetch existing service data from database
    // Replace 'DB_NAME' with your actual database name
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "carcare"; // Insert your database name here
    
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM servicetype WHERE servicetypeId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $serviceId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $serviceData = $result->fetch_assoc();
        }
        
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Determine if this is add or edit form
$isEdit = $serviceData !== null;
$formTitle = $isEdit ? "แก้ไขข้อมูลการบริการ" : "เพิ่มบริการใหม่";
$formSubtitle = $isEdit ? "อัปเดตข้อมูลบริการของคุณ" : "กรอกข้อมูลบริการของคุณ";
$formAction = $isEdit ? "../action/editService-action.php" : "../action/addService-action.php";
$buttonText = $isEdit ? "อัปเดตบริการ" : "บันทึกบริการ";
$serviceName = $isEdit ? $serviceData['servicetypeName'] : '';
$servicePrice = $isEdit ? $serviceData['servicetypePrice'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?php echo $formTitle; ?></title>
</head>
<body>
    <div class="w-full h-screen px-[20rem] flex justify-center items-center">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 shadow-2xl w-[35rem] rounded-xl p-8 relative flex flex-col space-y-6">
            <a href="http://localhost/Carcare/views/service.php" class="absolute top-6 right-6 text-gray-500 hover:text-gray-800 text-2xl font-bold">×</a>
            <div class="border-b-4 border-indigo-500 pb-4">
                <h1 class="text-3xl font-bold text-gray-800"><?php echo $formTitle; ?></h1>
                <p class="text-sm text-gray-600 mt-1"><?php echo $formSubtitle; ?></p>
            </div>
            <form action="../action/edit_service-action.php" method="post" class="flex flex-col justify-center space-y-5">
                <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($serviceId); ?>">
                <?php endif; ?>
                <div class="flex flex-col space-y-4">
                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-gray-700 font-semibold text-sm">ชื่อบริการ</label>
                        <input type="text" id="name" name="name" placeholder="เช่น ล้างรถ, เปลี่ยนน้ำมัน..." value="<?php echo htmlspecialchars($serviceName); ?>" class="bg-white border-2 border-gray-200 hover:border-indigo-400 focus:border-indigo-600 focus:outline-none p-3 rounded-lg transition duration-200" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="price" class="text-gray-700 font-semibold text-sm">ราคา (บาท)</label>
                        <input type="text" id="price" name="price" placeholder="เช่น 250, 500..." value="<?php echo htmlspecialchars($servicePrice); ?>" class="bg-white border-2 border-gray-200 hover:border-indigo-400 focus:border-indigo-600 focus:outline-none p-3 rounded-lg transition duration-200" required>
                    </div>
                </div>

                <button class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg py-3 px-6 font-bold text-lg shadow-md transition duration-200 self-center w-full" type="submit"><?php echo $buttonText; ?></button>
            </form>
        </div>
    </div>
</body>
</html>