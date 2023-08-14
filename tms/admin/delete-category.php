<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['cid'])) {
        $cid = intval($_GET['cid']);

        if (isset($_POST['confirm'])) {
             // Delete associated records from the ratings table
             $deleteRatingsSql = "DELETE FROM ratings WHERE item_id = $cid";
             mysqli_query($conn, $deleteRatingsSql);
             
            // Delete the related packages
            $deletePackagesSql = "DELETE FROM tbltourpackages WHERE CategoryId = $cid";
            mysqli_query($conn, $deletePackagesSql);

            // Delete the category
            $deleteCategorySql = "DELETE FROM tblcategory WHERE CategoryId = $cid";
            mysqli_query($conn, $deleteCategorySql);

            // Enable foreign key checks
            mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS=1');

            $msg = "Category and related packages deleted successfully.";
            $_SESSION['success'] = $msg;
            header('location: manage-category.php');
            exit();
        }
    } else {
        header('location: manage-category.php');
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
            <h2>Confirm Category Deletion</h2>
            <p>Are you sure you want to delete this category? This will also delete the related packages.</p>
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
