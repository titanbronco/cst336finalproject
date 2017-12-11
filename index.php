<?php
session_start();   //starts or resumes a session
function loginProcess() {
    if (isset($_POST['loginForm'])) {  //checks if form has been submitted
    
        include './functions.php';
        $conn = getDatabaseConnection();
      
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $sql = "SELECT username, password
                    FROM admins
                    WHERE username = :username
                    and password = :password";
            
            $namedParameters = array();
            $namedParameters[':username'] = $username;
            $namedParameters[':password'] = $password;
            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $record = $stmt->fetch();
            echo print_r($namedParameters);
            
            
            if (empty($record)) {
                
                echo "Wrong Username or password";
                
            } else {
                
               $_SESSION['username'] = $record['username'];
              // $_SESSION['adminName'] = $record['firstName'] . "  " . $record['lastName'];
               //echo $record['firstName'];
               header("Location: admin.php"); //redirecting to admin.php
                
            }
            print_r($record);
    }
    
    if(isset ($_POST['userLogin'])){
        include './functions.php';
        header("Location: user.php");
        
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <title>  Login  </title>
    </head>
    <body>


            <h1> Admin Login </h1>
            
            <form method="post">
                
                Username: <input type="text" name="username"/> <br />
                
                Password: <input type="password" name="password" /> <br />
                
                <input type="submit" name="loginForm" value="Login!"/>
                
            </form>
            
            <h1> OR continue as user</h1>
            
             <form method="post">
                
                <input type="submit" name="userLogin" value="user"/>
                
            </form>

            <br />
            
            <?=loginProcess()?>
    </body>
</html>