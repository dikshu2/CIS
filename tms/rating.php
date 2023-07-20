<?php
include('config.php');
error_reporting(E_ALL);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the rating data sent from the frontend
if (isset($_POST['item_id']) && isset($_POST['rating'])) {
    $item_id = $_POST['item_id'];
    $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : null;
    $rating = $_POST['rating'];

    // Insert the rating data into the 'ratings' table
    $sql = "INSERT INTO ratings (item_id, user_id, rating) VALUES ('$item_id', '$user_id', '$rating')";

    if ($conn->query($sql) === true) {
        echo "Rating added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>