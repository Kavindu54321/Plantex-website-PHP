

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


if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM questions WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: questions.php');
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
            <button class="btn-add left-btn"><a href="createQuestions.php">Add Record</a></button>
        </h2>

        <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                           <th>Id</th>
                            <th>Question Name</th>
                            <th>Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                       
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
          $query = "SELECT * FROM questions";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
          <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['question_name']; ?></td>
            <td><?php echo $row['answer']; ?></td>
            
            <td>
              <a href="editcategory.php?id=<?php echo $row['id']?>" class="btn btn-success btn-icon-split">
               
                <span class='icon text-white-50'>
                    <i class='fas fa-check'></i>
                </span>
                <span class='text'>Edit</span>
              </a>
              <a href="allcategory.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-icon-split">
              <span class='icon text-white-50'>
                    <i class='fas fa-trash'></i>
                </span>
            <span class='text'>Delete</span>
              </a>
            </td>
          </tr>
          <?php } ?>
                        
                    </tbody>
                </table>
                <?php
                    // Close the connection
                    $conn->close();
                    ?>	
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Plantex. All Rights Reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>



    
