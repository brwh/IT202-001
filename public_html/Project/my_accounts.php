
<?php
require(__DIR__ . "/../../partials/nav.php");
$user_id = get_user_id();
//echo $user_id;
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
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = '$user_id' AND closed != 1 LIMIT 100");
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
$count=0;
$flag = false;
while ($row = $display->fetch())
{   
    if($row["account_type"] == 'loan' and $row['balance'] == 0){
        continue;
    }
    if ($row['closed'] == 1){
        continue;
    }
    
    //echo 'this is user id ' . $user_id;
    if ($row["account_type"] == 'loan' or $row["account_type"] == 'savings'){

    
    $date = $row['modified'];
    $stamp = date('Y-m-d H:i:s');
    $one_year = date($date, strtotime("One year later"));
    if ($stamp > $one_year){
    $balance = $row['balance'];
    $account_number = $row['account_number'];
    $rn = .06 / 12;
    $rn1 = $rn + 1;
    $apy = ($rn1 ** 12) -1;   
    $balance = ($apy * $balance) + $balance;
        
    $upd = $pdo -> prepare('UPDATE Accounts
    SET balance = :balance
    WHERE account_number = :account_num ');
    $upd -> execute([':balance'=>$balance, ':account_num' => $account_number]);
    }

    
    
        
        echo '
     <tr>
      <td><a href= "./transaction_history.php?acct_num=' . $row['account_number'] . '"> '.$row["account_number"].' </a> </td>
      <td>'.$row["account_type"]. " APR: 6%" .' </td>
      <td>'.$row["balance"].' </td>
      
     </tr>
     ';
    }
    else {
    echo '
     <tr>
      <td><a href= "./transaction_history.php?acct_num=' . $row['account_number'] . '"> '.$row["account_number"].' </a> </td>
      <td>'.$row["account_type"].' </td>
      <td>'.$row["balance"].' </td>
      
     </tr>
     ';
    }
    
}
?>
</tbody>
   </table>
  </div>
 </body>
</html>

 


