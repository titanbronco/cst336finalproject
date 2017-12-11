<?php
session_start();
    if(!isset($_SESSION['username'])){
        
        header("Location: index.php");
    }
  include './functions.php';
  //$conn = getDatabaseConnection();

if(isset($_GET['updateCard'])){// checks whether admin has submitted form
$conn = getDatabaseConnection();
    echo "Form has been submitted!";
    $sql = "UPDATE cards
            SET price = :Price
            WHERE name = :Name";
    //$np = array();
    
   // echo $sql;
    
    
    
    $np[':Name'] = $_GET['name'];
    $np[':Price'] = (float)$_GET['price'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    
    //print_r($np);
    
    
    echo"Record has been updated!";
    
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Update User </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>

        <h1> Dragon Ball Super: Update Card Price </h1>
        <h3> <?php echo $_GET['name'] ?></h3>
        <form method="GET">
            <input type="hidden" name="name" value="<?=$_GET['name']?>">
            Price:<input type="text" name="price" />
            <br />

           
            <br />
            </select>
            <input type="submit" value="Update Card" name="updateCard">
        </form>

    </body>
</html>