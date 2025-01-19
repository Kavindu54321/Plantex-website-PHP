<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ruwan";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is provided
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // Fetch the record
    $sql = "SELECT * FROM plants WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $news = $result->fetch_assoc();
    } else {
        die("Record not found!");
    }
} else {
    die("Invalid request. ID is missing!");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news_name = $conn->real_escape_string($_POST['plant_name']);
    $news_category = $conn->real_escape_string($_POST['plant_price']);
    $news_description = $conn->real_escape_string($_POST['description']);
    $date = $conn->real_escape_string($_POST['date']);
    $image = $_FILES['image']['name'];

    // If a plants image is uploaded, handle it
    if (!empty($image)) {
        $target = __DIR__ . "/uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $sql = "UPDATE plants SET plant_name = '$news_name', plant_price = '$news_category', 
                description = '$news_description', date = '$date', image = '$image' WHERE id = $id";
    } else {
        $sql = "UPDATE plants SET plant_name = '$news_name', plant_price = '$news_category', 
                description = '$news_description', date = '$date' WHERE id = $id";
    }

    if ($conn->query($sql)) {
        header("Location: products.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
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
                    <input type="text" id="plant_name" name="plant_name"  value="<?php echo htmlspecialchars($news['plant_name']); ?>"placeholder="Enter plant_name" required>
                </div>

                <div class="form-group">
                    <label for="plant_price">plant_price:</label>
                    <input type="text" id="plant_price" name="plant_price"  value="<?php echo htmlspecialchars($news['plant_price']); ?>"placeholder="Enter plant_price" required>
                </div>
                <div class="form-group">
                    <label for="description">description:</label>
                    <input type="text" id="description" name="description"  value="<?php echo htmlspecialchars($news['description']); ?>"placeholder="Enter description" required>
                </div>
                <div class="form-group">
                    <label for="date">date:</label>
                    <input type="date" id="date" name="date"  value="<?php echo htmlspecialchars($news['date']); ?>" placeholder="Enter date" required>
                </div>
                <div class="form-group">
                    
                    
                    <label for="image">image:</label>
                    <img src="uploads/<?php echo htmlspecialchars($news['image']); ?>" alt="Current Image" width="150">
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
