CREATE TABLE IF NOT EXISTS `Roles`
(
    `id` int auto_increment not null,
    `name` varchar(100)    not null unique,
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)







)