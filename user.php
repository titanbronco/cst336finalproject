<?php
    session_start();
    //displays all info,
    if(isset($_GET['Filter'])) {
        $color = $_GET['Filter'];
        if($color == ' '){
            $color = 'All';
        }
    }
    else{
        $color = 'All';
    }
    
    
    //displays all info
    if(isset($_GET['Sort'])) {
        $sort = $_GET['Sort'];
    } else {
        $sort = "0";
    }
    
 
?>

<html>
    <head>
        <title>Online Store</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <link href="functions.php"/>
    </head>
    <body>
        <div id = "wrapper">

            <header>
                <h1>Welcome!</h1>
                <br>
                <h3>Filter and sort through Dragon Ball Super cards:</h3>
            </header>

            <form>
                Item Type:
                <select name = "Filter">
                    <option value = " ">Filter By</option>
                    <option value = "All">All</option>
                    <option value= "red">Red Cards</option>
                    <option value= "blue">Blue Cards</option>
                    <option value= "green">Green Cards</option>
                </select>
                <br>
                Sort by:
                <select name = "Sort">
                    <option value = "0">Sort By Price</option>
                    <option value = "ascending">Ascending</option>
                    <option value = "descending">Descending</option>
                </select>
                <br>
                <input type="submit" value="Search" name="submit">
            </form>
            
            <?php
                include "functions.php";
                
                $Cards = displayCards($sort, $color);
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
                    echo "</tr>";
                }
                echo "</table>";
                echo "<br/>";
                
           ?>


        </div>
        
    </body>
</html>