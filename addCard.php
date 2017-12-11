<?php
include './functions.php';
$conn = getDatabaseConnection();

if (isset($_GET['addCard'])) {  //the add form has been submitted
    $sql = "INSERT INTO cards
             (name, power, color, playcost, price) 
             VALUES
             (:Name, :Pow, :Color, :Cost, :Price)";
    $np = array();
    
    //echo "$sql";
    
    $np[':Name'] = $_GET['name'];
    $np[':Pow'] = $_GET['power'];
    $np[':Color'] = $_GET['color'];
    $np[':Cost'] = $_GET['playcost'];
    $np[':Price'] = $_GET['price'];
    
    $stmt=$conn->prepare($sql);
    $stmt->execute($np);
    
    print_r($np);
    
    echo "Card Was Added!";
    
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin: Add a new card!</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <script>
            function validateCard() {
                    
            $.ajax({
                type: "get",
                url: "functions.php",
                dataType: "json",
                data: {
                    'name': $('#name').val(),
                    'action': 'validate-card'
                },
                success: function(data,status) {
                    debugger;
                     $('#card-valid').css("color", "green");
                     //alert(status);
                    if (data.length > 0) {
                     
                         
                        $('#card-valid').html("Card Exists"); 
                        $('#card-valid').css("color", "red");
                    } else {
                        $('#card-valid').html("Card is available");
                    }
                    
                  },
                
                complete: function(data,status) { //optional, used for debugging purposes
                    // alert(status);
                }
            });
                }
        </script>
    </head>
    <body>


            <h1> Adding New Card </h1>

            <h2> Add a new card to the database </h2>
    
            <form method="GET">
                Card Name:<input onchange=validateCard(); type="text" name="name" id="name" /> <span id="card-valid"></span>
                <br />
                Power:<input type="text" name="power"/>
                <br/>
                Play Cost: <input type= "text" name ="playcost"/>
                <br/>
                Price: <input type ="text" name= "price"/>
                <br />
               Color: 
               <select name="color">
                    <option value=""> - Select One - </option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
                <br />
                    
                    
                    
                </select>
                <input type="submit" value="Add Card" name="addCard">
            </form>

    </body>
</html>