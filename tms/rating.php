<?php
include('includes/config.php');
error_reporting(E_ALL);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data sent from the frontend
    $requestData = json_decode(file_get_contents('php://input'), true);

    if ($requestData) {
        $rating = $requestData['rating'];
        $item_id = $requestData['item_id'];
        $UserEmail = $requestData['login'];
    }
    $sql = "INSERT INTO ratings(item_id, userEmail, rating) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $item_id, $UserEmail, $rating);
    
        if ($stmt->execute()) {
            echo "Rating added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
    
    $conn->close();
    echo "helooo";
}

?>
