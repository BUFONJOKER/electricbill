CREATE TABLE `electricbill`.`bill` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `meter_number` VARCHAR(255) NOT NULL,
    `month` VARCHAR(255) NOT NULL,
    `year` VARCHAR(255) NOT NULL,
    `units` INT(11) NOT NULL,
    `total_amount` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;