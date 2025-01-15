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

// SQL query to fetch data from the 'new' table
$sql = "SELECT id, image, plant_name, plant_price, description, date FROM plants";
$result = $conn->query($sql);



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM plants  WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: products.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantex Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h2>Plantex Admin</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <header>
            <div class="header-container">
                <h1>Welcome to the Plantex Admin Panel</h1>
            </div>
        </header>

        <h2 class="manage" >Manage Records
            <button class="btn-add left-btn"><a href="createProducts.php">Add Record</a></button>
        </h2>

        <table class="crud-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>image</th>
                    <th>plant_name</th>
                    <th>plant_price</th>
                    <th>description</th>
                    <th>date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            // Display the image with a relative path
                            echo "<td><img src='uploads/" . $row['image'] . "' alt='News Image' style='width: 100px; height: 100px;'></td>";
                            echo "<td>" . $row['plant_name'] . "</td>";
                            echo "<td>" . $row['plant_price'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            // Break out of PHP for the action buttons
                            ?>
                            <td>
                           
                                            <a href="editProducts.php?id=<?php echo $row['id']; ?>" class="edit-btn">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>
                                        
                                <form method="POST" action="delete.php" style="display:inline;" 
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="delete-btn">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete</span>
                                    </button>
                                </form>
                            </td>
                            <?php
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No data found</td></tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Plantex. All Rights Reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
