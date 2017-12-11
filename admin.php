<?php
session_start();
if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page </title>
        <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete this user?");
                
            }
            
        </script>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
    <body>

            <h1> Admin Main </h1>
            <h2> Welcome <?=$_SESSION['username']?>!</h2>
            
            <form action="addCard.php">
                
                <input type="submit" value="Add New Card" />
                
            </form>
            
            
            <form action="logout.php">
                
                <input type="submit" value="Logout!" />
                
            </form>
            
            <form>
                
                <input type="submit" name="reports" value="Generate Reports" />
                
            </form>
            
            
            
            <br />
            
            <?php
            include './functions.php';
            
            if(isset($_GET['reports'])){
                echo "Amount of Blue Cards: ";
                $amount = numberCards("blue");
                echo $amount[0][c];
                echo '<br>';
                echo "Amount of Red Cards: ";
                $amount = numberCards("red");
                echo $amount[0][c];
                echo '<br>';
                echo "Amount of Green Cards: ";
                $amount = numberCards("green");
                echo $amount[0][c];
                echo '<br>';
                echo "Average Power of All Cards: ";
                $power = avgPower();
                echo $power[0][a];
                echo '<br>';
                echo "Average Price of All Cards: $";
                echo $power[0][pr];
                echo '<br>';
            }
            
             $Cards = displayCards(0, 'All');
        
                echo "<table id='table'>";
                echo "<tr>";
                echo "<td>'Card Name'</td>";
                echo "<td>'Power'</td>";
                echo "<td>'Color'</td>";
                echo "<td>'Play Cost'</td>";
                echo "<td>'Price in $'</td>";
                foreach($Cards as $card) {
                    echo "<tr>";
                    echo "<td>". $card['name'] ."</td>";
                    echo "<td>". $card['power'] ."</td>";
                    echo "<td>". $card['color'] ."</td>";
                    echo "<td>". $card['playcost'] ."</td>";
                    echo "<td>". $card['price'] ."</td>";
                    echo "<td>";
                    echo " [<a href='updateCard.php?name=".$card['name']."'> Update </a>] ";
                    echo "</td>";
                    echo "<td>";
                    echo "[<a onclick='return confirmDelete()' href='deleteCard.php?name=".$card['name']."'> Delete </a>] <br />";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<br/>";
             
             
             
             
             ?>
            
    </body>
</html>