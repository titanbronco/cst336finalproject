<?php
    include './functions.php';
    $conn = getDatabaseConnection();
    
    $name = $_GET['name'];
    
    $sql = "DELETE FROM cards
            WHERE name = '$name' ";
            
            //echo $_GET['name'];
            //echo $sql;
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: admin.php");
?>

