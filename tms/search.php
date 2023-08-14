<?php
include('includes/config.php');
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];

    // Search in tblcategory for CategoryName
    $sqlCategory = "SELECT * FROM tblcategory WHERE CategoryName LIKE :searchTerm";
    $queryCategory = $dbh->prepare($sqlCategory);
    $queryCategory->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
    $queryCategory->execute();
    $categoryResults = $queryCategory->fetchAll(PDO::FETCH_OBJ);

    // Search in tbltourpackages for PackageName
    $sqlPlace = "SELECT * FROM tbltourpackages WHERE PackageName LIKE :searchTerm";
    $queryPlace = $dbh->prepare($sqlPlace);
    $queryPlace->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
    $queryPlace->execute();
    $placeResults = $queryPlace->fetchAll(PDO::FETCH_OBJ);

    // Combine and prepare search results
    $searchResults = array_merge($categoryResults, $placeResults);

    // Prepare the output
    if (!empty($searchResults)) {
        $output = '';
        foreach ($searchResults as $result) {
            if (isset($result->CategoryName)) {
                $output .= "Category: " . $result->CategoryName . "<br>";
            }
            if (isset($result->PackageName)) {
                $output .= "Place: " . $result->PackageName . "<br>";
            }
        }
        echo $output;
    } else {
        echo "No results found.";
    }
}
?>
