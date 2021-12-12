
CREATE TABLE IF NOT EXISTS `Transactions`
(
    `AccountSrc` INT(100),
    `AccountDest` INT(100),
    `BalanceChange` VARCHAR(200),
    `Transaction Type` VARCHAR(200),
    `Memo` VARCHAR(200),
    `Created` timestamp default current_timestamp,


)