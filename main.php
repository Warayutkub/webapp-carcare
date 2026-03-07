<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./styles/main.css">
    <title>Carcare System</title>
</head>

<body>

    <!-- Navbar -->
    <?php
    include './styles/components/Navbar.php';
    ?>

    <div class="w-full px-4 px-[20rem]">
        <div class="bg-gray-300 p-2 m-2 rounded-md w-fit flex gap-4">
            <a href="http://localhost/Carcare/main.php" class="bg-white p-2 rounded animate-fade-in-bg ">
                Dashboard
            </a>
            <a href="http://localhost/Carcare/views/queqe.php" class="p-2">
                Queqe
            </a>
            <a href="http://localhost/Carcare/views/service.php" class="p-2">
                Service
            </a>
        </div>
    </div>

    <?php
    include './styles/components/Dashboard.php';
    ?>
</body>

</html>