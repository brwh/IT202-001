<?php 
require(__DIR__ . "/../../partials/nav.php");
?>

<html>
<style>
table, th, td {
  border:1px solid black

}


</style>

<h1> Accounts: </h1>

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
$display = $pdo->prepare('
SELECT Transactions.AccountSrc, Transactions.AccountDest, Transactions.BalanceChange, Transactions.TransactionType, Transactions.Memo, Transactions.Created
FROM Transactions
INNER JOIN Accounts
ON Transactions.AccountSrc = Accounts.user_id
WHERE Accounts.account_number = :aid
');
//$display = $pdo->prepare("SELECT * FROM Transactions INNER JOIN Accounts ON Transactions.AccountSrc = Accounts.user_id WHERE Accounts.account_number = :aid LIMIT 10" );
$display->execute([":aid"=>$acct_id]);

$display->setFetchMode(PDO::FETCH_ASSOC);



while ($row = $display->fetch())
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

echo '<a href= "./view_all.php?acct_num=' . $acct_id . '"> Click here to view more transactions </a>';

?>

</tbody>

   </table>
   </body>

<?php
if(isset($_POST['sort-type'])){
    $sort = $pdo->prepare("SELECT * FROM Transactions INNER JOIN Accounts ON Transactions.AccountSrc = Accounts.user_id WHERE Accounts.account_number = '$acct_id' ORDER BY Transactions.TransactionType " );
    $sort->execute();
    while ($row = $display->fetch())
{   if($count < 10){
    
    
    


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
}
?>   

  
 
</html>


