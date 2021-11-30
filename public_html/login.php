<?php 
session_start();
include 'xfetchinfo.php';

include 'login_check.php';
include 'db.php';
if(!check_login()) {
    header('Location: ./index.php');
}
?>

<html>
<style>
    body {
        background-color: beige;
        font: 20px Verdana, Sans-Serif;
    }
    h1{
        font: 30px Verdana, Sans-Serif;
    }
</style>


<h1> <?php echo 'Welcome to your Dashboard ' . $username . ' ' . $user_id .  ' !'; ?> <br><br> </h1>
<?php include 'xferinfo.php'; ?>
<nav>
    <a href="logout.php">Logout</a> <br></html> <br>
    <a href="account_edit.php">Edit account information</a> <br>
    <a href="create_bank_account.php"> Create Bank Account</a> <br>
    <a href="myAccounts.php"> View My Bank Accounts</a> <br>
    <a href="transactions.php"> Deposit / Withdrawal / Transfer</a> <br>
    <a href="t_history.php"> Transaction History</a> <br>
</nav>   
<html>