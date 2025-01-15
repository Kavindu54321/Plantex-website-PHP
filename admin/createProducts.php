<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ruwan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $name = $conn->real_escape_string($_POST['plant_name']);
    $category = $conn->real_escape_string($_POST['plant_price']);
    $description = $conn->real_escape_string($_POST['description']);
    $date = $conn->real_escape_string($_POST['date']);
    $image = $_FILES['image']['name'];
    $target = __DIR__ . "/uploads/" . basename($image);

    // Create the 'uploads' directory if it doesn't exist
    if (!is_dir(__DIR__ . "/uploads")) {
        mkdir(__DIR__ . "/uploads", 0755, true);
    }

    // Image upload validation
    if (!empty($image)) {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = pathinfo($image, PATHINFO_EXTENSION);

        if (in_array(strtolower($file_extension), $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                // Prepared statement to avoid SQL injection
                $stmt = $conn->prepare("INSERT INTO plants (plant_name, plant_price, description, date, image) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $name, $category, $description, $date, $image);

                if ($stmt->execute()) {
                    header("Location: products.php");
                    
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Failed to upload image. Please check the 'uploads' directory permissions.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Please upload an image.";
    }
}



$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create/Edit Record - Plantex Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h2>Plantex Admin</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.html">Dashboard</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="products.html">Products</a></li>
            <li><a href="users.html">Users</a></li>
            <li><a href="settings.html">Settings</a></li>
            <li><a href="logout.html">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <header>
            <div class="header-container">
                <h1>Create or Edit Record</h1>
            </div>
        </header>

        <!-- Form to Add/Edit Record -->
        <div class="form-container">
            <h2>Record Details</h2>
            <form method="POST" class="news-form" enctype="multipart/form-data">
                <input type="hidden" id="record-id" name="record-id" value=""> <!-- To identify the record for editing -->

                <div class="form-group">
                    <label for="plant_name">plant_name:</label>
                    <input type="text" id="plant_name" name="plant_name" placeholder="Enter plant_name" required>
                </div>

                <div class="form-group">
                    <label for="plant_price">plant_price:</label>
                    <input type="text" id="plant_price" name="plant_price" placeholder="Enter plant_price" required>
                </div>
                <div class="form-group">
                    <label for="description">description:</label>
                    <input type="text" id="description" name="description" placeholder="Enter description" required>
                </div>
                <div class="form-group">
                    <label for="date">date:</label>
                    <input type="date" id="date" name="date" placeholder="Enter date" required>
                </div>
                <div class="form-group">
                    <label for="image">image:</label>
                    <input type="file" id="image" name="image" placeholder="Enter image" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn-submit">Save Record</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Plantex. All Rights Reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
