<?php
include('includes/config.php');

if (isset($_GET['id'])) {
    $notificationId = $_GET['id'];

    // Update the "seen" status in the database
    $sql = "UPDATE notification SET seen = 1 WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $notificationId, PDO::PARAM_INT);

    $success = $query->execute();

    // Redirect back to the page where notifications are displayed
    if ($success) {
        header('Location: notification.php');
        exit();
    } else {
        echo "Error updating notification status.";
    }
}
?>
