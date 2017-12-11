<?php
function getDatabaseConnection()
{
    // $host = "us-cdbr-iron-east-05.cleardb.net";
    // $username = "bbf7de8df9454c";
    // $password = "441ff6f0";
    // $dbname="heroku_876ef2f60b62635";
    
    // $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // return $dbConn;
    
    $host = "us-cdbr-iron-east-05.cleardb.net";
     $username = "bbf7de8df9454c";
     $password = "441ff6f0";
    $dbname="heroku_6ed4258c62bdf7f";
// Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    return $conn;
    
  }
  
  function displayCards($sort, $color) {
    $conn = getDatabaseConnection();
    
    if($color == 'All'){
        if($sort == "0") {
            $sql = "SELECT * FROM cards";
        } else if($sort == "ascending") {
            $sql = "SELECT * FROM cards ORDER BY price ASC";
        } else if($sort == "descending") {
            $sql = "SELECT * FROM cards ORDER BY price DESC";
        }
    }
    else{
        if($sort == "0") {
            $sql = "SELECT * FROM cards WHERE color = '$color'";
        } else if($sort == "ascending") {
            $sql = "SELECT * FROM cards WHERE color ='$color' ORDER BY price ASC";
        } else if($sort == "descending") {
            $sql = "SELECT * FROM cards WHERE color = '$color' ORDER BY price DESC";
        }
    }
    
   // echo $sql;
                
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
               
    return $records;
}

function numberCards($color) {
    $conn = getDatabaseConnection();
    $sql = "Select count(*) as c from cards where color='$color'";
    
    //echo $sql;
                
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);
               
    return $records;
}

function avgPower() {
    $conn = getDatabaseConnection();
    $sql = "Select AVG(power) as a, AVG(price) as pr from cards";
    
    //echo $sql;
                
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);
               
    return $records;
}

function getMatchingCards() {
    
     $name = $_GET['name']; 
    
     //echo $name;
    
     $dbConn = getDatabaseConnection(); 
     $sql = "SELECT * from cards WHERE name='$name'"; 
     
     $statement = $dbConn->prepare($sql); 
    
     $statement->execute(); 
     $records = $statement->fetchAll(); 
     echo json_encode($records); 
}
getMatchingCards();
?>