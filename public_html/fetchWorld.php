<?php 
    $findWorld = $pdo->prepare("SELECT * FROM Accounts WHERE account_type= 'world'");
    $findWorld->execute();
    $worldResult = $findWorld->fetch(PDO::FETCH_ASSOC);
    

if(!$worldResult){
    $insertWorld = $pdo->prepare("INSERT INTO Accounts(id,account_number,user_id,balance,account_type) VALUES(3,'000000000000',3,0,'world'");
    $insertWorld->execute();
}
while ($row = $findWorld->fetch(PDO::FETCH_ASSOC)){
        $world_balance = $row['balance'];

}
?>