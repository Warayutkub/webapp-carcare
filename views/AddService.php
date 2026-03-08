<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>เพิ่มบริการ</title>
</head>

<body>
    <div class="w-full h-screen px-[20rem] flex justify-center items-center">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 shadow-2xl w-[35rem] rounded-xl p-8 relative flex flex-col space-y-6">
            <a href="http://localhost/Carcare/views/service.php" class="absolute top-6 right-6 text-gray-500 hover:text-gray-800 text-2xl font-bold">×</a>
            <div class="border-b-4 border-indigo-500 pb-4">
                <h1 class="text-3xl font-bold text-gray-800">เพิ่มบริการใหม่</h1>
                <p class="text-sm text-gray-600 mt-1">กรอกข้อมูลบริการของคุณ</p>
            </div>
            <form action="../action/addService-action.php" method="post" class="flex flex-col justify-center space-y-5">
                <div class="flex flex-col space-y-4">
                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-gray-700 font-semibold text-sm">ชื่อบริการ</label>
                        <input type="text" id="name" name="name" placeholder="เช่น ล้างรถ, เปลี่ยนน้ำมัน..." class="bg-white border-2 border-gray-200 hover:border-indigo-400 focus:border-indigo-600 focus:outline-none p-3 rounded-lg transition duration-200">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="price" class="text-gray-700 font-semibold text-sm">ราคา (บาท)</label>
                        <input type="text" id="price" name="price" placeholder="เช่น 250, 500..." class="bg-white border-2 border-gray-200 hover:border-indigo-400 focus:border-indigo-600 focus:outline-none p-3 rounded-lg transition duration-200">
                    </div>
                </div>

                <button class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg py-3 px-6 font-bold text-lg shadow-md transition duration-200 self-center w-full" type="submit">บันทึกบริการ</button>
            </form>
        </div>
    </div>
</body>

</html>