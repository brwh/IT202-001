CREATE TABLE IF NOT EXISTS `UserRoles`
(
    `id` int auto_increment not null,
    `user_id` int,
    `role_id` int,
    `name` varchar(100)    not null unique,
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES Users(`id`),
    FOREIGN KEY (`role_id`) REFERENCES Roles(`id`),
    UNIQUE KEY (`user_id`, `role_id`)






)