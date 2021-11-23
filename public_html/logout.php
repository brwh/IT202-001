<?php
session_start();
echo '<script>alert("You have successfully logged out")</script>';
session_destroy(); 

header('Location: ./index.php');

?>