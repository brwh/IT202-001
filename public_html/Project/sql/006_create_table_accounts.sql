CREATE TABLE IF NOT EXISTS `Accounts`
(
    `id` int auto_increment not null,
    `account_number` char(12),
    `user_id` int,
    `balance` int default 0,
    `account type` varchar(100),    
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES Users(`id`),
    UNIQUE KEY (`user_id`, `account_number`)
)