<html>
<style>
table, th, td {
  border:1px solid black

}
</style>
<h1> Accounts: </h1>
    <body>
        <a href="logout.php">Logout</a> <br></html> <br> 
        <a href="login.php">Go Back to Main Dashboard</a> <br>
</body>

<table>
    <thead>
        <tr>
        <th> Account </th>
        </tr>
    </thead>
    <tbody id = "table_data">
<?php 
include 'login_check.php';
session_start();
include "db.php";
include "xfetchinfo.php";
$pdo = getDB();
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = '$user_id'");
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
$count=0;
while ($row = $display->fetch())
{   if($count < 5){

    echo '
     <tr>
      <td><a href= "./login.php"> '.$row["account_type"].' </a> </td>
      
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

 


