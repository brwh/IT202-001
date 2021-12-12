
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


$pdo = getDB();
$display = $pdo->prepare("SELECT * FROM Transactions WHERE AccountSrc OR AccountDest = '$user_id'");
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);


$count=0;
while ($row = $display->fetch())
{   if($count < 10){
    echo '
     <tr>
      <td>'.$row["AccountSrc"].' </td>
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
?>
</tbody>
   </table>
  </div>
 </body>
</html>


=======
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


$pdo = getDB();
$display = $pdo->prepare("SELECT * FROM Transactions WHERE AccountSrc OR AccountDest = '$user_id'");
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);


$count=0;
while ($row = $display->fetch())
{   if($count < 10){
    echo '
     <tr>
      <td>'.$row["AccountSrc"].' </td>
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
?>
</tbody>
   </table>
  </div>
 </body>
</html>



