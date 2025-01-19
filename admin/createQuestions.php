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

if (isset($_POST['submit'])) {
  $name = $_POST['question_name'];
  $code = $_POST['answer'];
  $query = "INSERT INTO questions(question_name, answer) VALUES ('$name', '$code')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: questions.php');

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
                    <label for="question_name">question_name:</label>
                    <input type="text" id="question_name" name="question_name" placeholder="Enter plant_name" required>
                </div>

                <div class="form-group">
                    <label for="answer">answer:</label>
                    <textarea type="text" id="answer" name="answer" placeholder="Enter plant_price" required></textarea>
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
