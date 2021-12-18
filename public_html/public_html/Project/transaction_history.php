<html>
<style>
table, th, td {
  border:1px solid black

}
</style>
<h1> Accounts: </h1>

<table>
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
require(__DIR__ . "/../../partials/nav.php");
$user_id = get_user_id();
$acct_id = $_GET['acct_num'];
echo $acct_id;

$pdo = getDB();


$display = $pdo->prepare("SELECT * FROM Transactions INNER JOIN Accounts ON Transactions.AccountSrc = Accounts.user_id WHERE Accounts.account_number = '$acct_id' " );
$display->execute();

$display->setFetchMode(PDO::FETCH_ASSOC);


$count=0;
while ($row = $display->fetch())
{   if($count < 10){
    
    
    


    echo '
     <tr>
      <td>'.$row["AccountSrc"]  . ' - '  . $row["account_number"] . ' </td>
      <td>'.$row["AccountDest"].' </td>
      <td>'.$row["BalanceChange"].' </td>
      <td>'.$row["TransactionType"].' </td>
      <td>'.$row["Memo"].' </td>
      <td>'.$row["Created"].' </td>
     </tr>
     ';
     $count +=1;
    }
}
echo '<a href= "./view_all.php?acct_num=' . $acct_id . '"> Click here </a>';
?>

</tbody>
   </table>
  </div>
 </body>
</html>


