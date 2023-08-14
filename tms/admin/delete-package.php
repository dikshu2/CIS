<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['pid'])) {
        $cid = intval($_GET['pid']);

        if (isset($_POST['confirm'])) {
            // Delete associated records from the ratings table
            $deleteRatingsSql = "DELETE FROM ratings WHERE item_id = $cid";
            mysqli_query($conn, $deleteRatingsSql);

            // Delete the category from tbltourpackages once associated records are deleted
            $deleteCategorySql = "DELETE FROM tbltourpackages WHERE PackageId = $cid";
            mysqli_query($conn, $deleteCategorySql);

            $msg = "Place and associated records deleted successfully.";

            $_SESSION['success'] = $msg;
            header('location: manage-package.php');
            exit();
        }
    } else {
        header('location: manage-package.php');
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Delete Category Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #ffffff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 5px;
        }

        .modal-content h2 {
            margin-top: 0;
        }

        .modal-content p {
            margin-bottom: 20px;
        }

        .modal-content form {
            display: inline-block;
        }

        .modal-content input[type="submit"] {
            background-color: #34ad00;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        .modal-content input[type="submit"]:hover {
            background-color: green;
        }

        .modal-content a {
            text-decoration: none;
            color: #333333;
            margin-left: 10px;
        }
    </style>
    <script>
        window.onload = function() {
            openModal();
        };

        function openModal() {
            document.getElementById("modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }
    </script>
</head>
<body>
    <div id="modal" class="modal">
        <div class="modal-content">
            <h2>Confirm Place Deletion</h2>
            <p>Are you sure you want to delete this Place?</p>
            <form method="post">
                <input type="submit" name="confirm" value="Delete">
                <a href="manage-category.php">Cancel</a>
            </form>
        </div>
    </div>
    <!-- <button onload="openModal()">Open Confirmation</button> -->

    <script>
        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById("modal")) {
                closeModal();
            }
        }
    </script>
</body>
</html>
