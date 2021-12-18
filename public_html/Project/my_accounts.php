
<?php
require(__DIR__ . "/../../partials/nav.php");
$user_id = get_user_id();
echo $user_id;
?>

<html>
<style>
table, th, td {
  border:1px solid black

}
</style>
<h1>  Accounts </h1>


<table>
    <thead>
        <tr>
        <th> Account Number </th>
        <th> Account Type </th>
        <th> Balance </th>
        </tr>
    </thead>
    <tbody id = "table_data">
<?php 

$pdo = getDB();
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = '$user_id'");
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
$count=0;
while ($row = $display->fetch())
{   if($count < 5){
    //echo 'this is user id ' . $user_id;
    $_POST['acct_num'] = $row["account_number"];  
    echo '
     <tr>
      <td><a href= "./transaction_history.php?acct_num=' . $row['account_number'] . '"> '.$row["account_number"].' </a> </td>
      <td>'.$row["account_type"].' </td>
      <td>'.$row["balance"].' </td>
      
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

 


