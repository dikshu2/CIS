<?php
error_reporting(E_ALL);
include('configuration.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Construct the SQL query to delete the user from chat_people
    $sql = "DELETE FROM chat_people WHERE Id = :user_id";

    // Prepare and execute the query
    $query = $db->prepare($sql);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($query->execute()) {
        // User removed successfully
        header('Location: box.php'); // Redirect back to the admin page
        exit();
    } else {
        // Handle error, if any
        echo "Error: Unable to remove the user.";
    }
} else {
    echo "Invalid user ID.";
}
?>
