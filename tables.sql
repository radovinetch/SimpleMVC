CREATE TABLE IF NOT EXISTS `tasks`
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username` VARCHAR(48) NOT NULL,
    `email` VARCHAR(96) NOT NULL,
    `text` TEXT NOT NULL,
    `status` INT(1) DEFAULT 0,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `users`
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username` VARCHAR(48) NOT NULL,
    `password` VARCHAR(96) NOT NULL,
    `role` INT(1) DEFAULT 0,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `users` (`username`, `password`, `role`) VALUES ('admin', '123', 1);

INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');
INSERT INTO `tasks` (`username`, `email`, `text`) VALUES ('radovinetch', 'test@gmail.com', 'Выполнить задачу!');