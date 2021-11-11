<?php


//for this we'll turn on error output so we can try to see any problems on the screen
//this will be active for any script that includes/requires this one
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function getDB(){
    global $db;
    //this function returns an existing connection or creates a new one if needed
    //and assigns it to the $db variable
    if(!isset($db)) {
        try{
            //__DIR__ helps get the correct path regardless of where the file is being called from
            //it gets the absolute path to this file, then we append the relative url (so up a directory and inside lib)
            require_once("C:/IT202-001 HW&Repos/IT202-001/lib/config.php");//pull in our credentials // ********THIS WOULD NOT WORK IF I DIDNT HARD CODE IT****************
            //use the variables from config to populate our connection
            $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
            //using the PDO connector create a new connect to the DB
            //if no error occurs we're connected
            $db = new PDO($connection_string, $dbuser, $dbpass);
	    //the default fetch mode is FETCH_BOTH which returns the data as both an indexed array and associative array
	    //we'll override the default here so it's always fetched as an associative array
 	    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}
   	catch(Exception $e){
            var_export($e);
            $db = null;
        }
    }
    return $db;
}


 $pdo = getDB();
 
 $table = 'Users';
 
    $sql = "CREATE TABLE IF NOT EXISTS $table(
        id INT( 11 ) NOT NULL AUTO_INCREMENT,
        email VARCHAR ( 250 ) NOT NULL,
        password VARCHAR ( 250 ) NOT NULL,
        PRIMARY KEY (id));";
        $pdo->exec($sql);

 

    if(isset($_POST['submit']))//check if user exists in sql db
    {
        $email = trim($_POST['uid']); 
        $password = trim($_POST['pw']);  
        if(empty($user_id)){
            $error = "Empty username";
            $_SESSION["error"] = $error;
            header("Location: index.php?Username is empty");
            exit();
        }
        if(empty($password)){
            $error = "Empty password";
            $_SESSION["error"] = $error;
            header("Location: index.php");
            exit();
        }
        
        $result = $pdo->query("SELECT email, password FROM Users WHERE email=$user_id");

        if ($result->rowCount() == 1){
            $row = $stmt->fetch();
            // verify password
            if (password_verify($password, $row["password"])){
                //login successful
                echo 'Logged in';
                $_SESSION["logged_in"]=true;
                $_SESSION["email"]=$row["email"];
                header("Location: other.php");
                exit();
            
                
            }
            else {
                //login unsuccessful
                $error = "Invalid email/password";
                $_SESSION["error"] = $error;
                echo 'Email or Password is incorrect';
                header("Location: index.php");
                exit();
            }
        }
        else {
            //login unsuccessful
            $error = "Invalid email/password";
            $_SESSION["error"] = $error;
            echo 'Email or Password is incorrect';
            header("Location: index.php");
            exit();
        }
    }
    else if(isset($_POST['submitNewUser'])){//insert new user in sql db
        $email = $_POST['uid']; 
        $password = $_POST['pw'];
        if (strlen($password) < 3) { //registration unsuccessful try again
            $error = "Password too short, must be more than 3 characters";
            $_SESSION["error"] = $error;
            header("Location: index.php");
            exit();

        }


        $password = password_hash($password, PASSWORD_DEFAULT);
        
        
        
        if(empty($email)){
            $error = "Empty email registration";
            $_SESSION["error"] = $error;
            header("Location: index.php");
            exit();
        }
        if(empty($password)){
            $error = "Empty password registration";
            $_SESSION["error"] = $error;
            header("Location: index.php");
            exit();
        }
        
        $user_insert = "INSERT INTO Users (id, email, password) VALUES (id, :email, :password)";
        $stmt = $pdo->prepare($user_insert);
        $stmt->execute([1,":email" => $email, ":password" => $password]) ; //keeps asking for an id to be specified?
        header("Location: index.php");
    }
?>

