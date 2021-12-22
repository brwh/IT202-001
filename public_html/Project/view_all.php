<?php 
require(__DIR__ . "/../../partials/nav.php");
?>
<html>

<style>
table, th, td {
  border:1px solid black

}
</style>
<input type ="submit" id = "sort-type" name = "sort-type" value="Sort By Transaction Type">
<h1> Account's History: </h1>

<table id = "acctsTable">
    <thead>
        <tr>
        <th> Account Source </th>
        <th> Account Destination </th>
        <th> Balance Change </th>
        <th> Transaction Type </th>
        <th> Memo </th>
        <th> Created </th>
        </tr>
    </thead>
    <tbody id = "table_data">


<?php 

$user_id = get_user_id();
$acct_id = $_GET['acct_num'];
echo $acct_id;

$pdo = getDB();


$display = $pdo->prepare("SELECT * FROM Transactions INNER JOIN Accounts ON Transactions.AccountSrc = Accounts.user_id WHERE Accounts.account_number = '$acct_id' " );
$display->execute();

$display->setFetchMode(PDO::FETCH_ASSOC);


$count=0;
while ($row = $display->fetch())
{ 
    
    
    


    echo '
     <tr>
      <td>'.$row["AccountSrc"]  .' </td>
      <td>'.$row["AccountDest"].' </td>
      <td>'.$row["BalanceChange"].' </td>
      <td>'.$row["TransactionType"].' </td>
      <td>'.$row["Memo"].' </td>
      <td>'.$row["Created"].' </td>
     </tr>
     ';

}
?>
</tbody>
</table>
<?php
if(isset($_POST["sort-type"])){
    echo "HELLO";
    $sort = $pdo->prepare("SELECT * FROM Transactions INNER JOIN Accounts ON Transactions.AccountSrc = Accounts.user_id WHERE Accounts.account_number = '$acct_id' " );
    $sort->execute();
    while ($row = $sort->fetch())
{   
    
    
    


    echo '
     <tr>
      <td>'.$row["AccountSrc"] . '</td>
      <td>'.$row["AccountDest"].' </td>
      <td>'.$row["BalanceChange"].' </td>
      <td>'.$row["TransactionType"].' </td>
      <td>'.$row["Memo"].' </td>
      <td>'.$row["Created"].' </td>
     </tr>
     ';
     
    }
}

?>   

</html>