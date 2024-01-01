CREATE TABLE `electricbill`.`customer` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `meter_number` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `contact` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`id`)
) ENGINE = InnoDB;