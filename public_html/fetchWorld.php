<?php 
    $pdo = getDB();
    $findWorld = $pdo->prepare("SELECT * FROM Accounts WHERE account_type= 'world'");
    $findWorld->execute();
    $worldResult = $findWorld->fetch(PDO::FETCH_ASSOC);
    

if(!$worldResult){
    $insertWorld = $pdo->prepare("INSERT INTO Accounts(id,account_number,user_id,balance,account_type) VALUES(3,'000000000000',3,1000,'world'");
    $insertWorld->execute();
}
$findWorld = $pdo->prepare("SELECT * FROM Accounts WHERE account_type= 'world'");
$findWorld->execute();
while ($row = $findWorld->fetch(PDO::FETCH_ASSOC)){
        $world_balance = $row['balance'];
        $world_type = $row['account_type'];
        $world_id = $row['user_id'];
}
$_SESSION['world_balance'] = $world_balance;
$_SESSION['world_type'] = $world_type;
$_SESSION['world_id'] = $world_id;

?>