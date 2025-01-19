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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']); // Sanitize input

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM plants WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: products.php?message=Record+deleted+successfully");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = intval($_POST['id']); // Sanitize input
    
        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            header("Location: questions.php?message=Record+deleted+successfully");
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    
        $stmt->close();
    }
    $stmt->close();
}



$conn->close();
?>

