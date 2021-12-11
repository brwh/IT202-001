<?php
session_start();
require(__DIR__ . "/../../lib/functions.php");
reset_session();

flash("Successfully logged out", "success");
header("Location: login.php");

/*<?php
session_start();
echo '<script>alert("You have successfully logged out")</script>';
session_destroy(); 

header('Location: ./index.php');

?>*/