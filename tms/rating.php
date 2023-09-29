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
if ($UserEmail != NULL) {
    $selectSql = "SELECT * from ratings where userEmail=:userEmail AND item_id=:itemId";
    $query = $dbh->prepare($selectSql);
    $query-> bindParam(':itemId', $item_id, PDO::PARAM_STR);
    $query-> bindParam(':userEmail', $UserEmail, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    $con="update ratings set rating=:rating where UserEmail=:email AND item_id=:itemId";
    $updateRating = $dbh->prepare($con);
    $updateRating-> bindParam(':rating', $rating, PDO::PARAM_STR);
    $updateRating-> bindParam(':itemId', $item_id, PDO::PARAM_STR);
    $updateRating-> bindParam(':email', $UserEmail, PDO::PARAM_STR);
    $updateRating->execute();
    $msg="Your rating updated successfully";
     }
    else{
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
    }
    
    }
    else {
        echo "plaese login to give your rating";
    }
}   
?>
