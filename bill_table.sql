CREATE TABLE `electricbill`.`bill` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `meter_number` VARCHAR(255) NOT NULL,
    `month` VARCHAR(255) NOT NULL,
    `year` VARCHAR(255) NOT NULL,
    `units` VARCHAR(255) NOT NULL,
    `total_amount` VARCHAR(255) NOT NULL,
    `previous_meter_reading` VARCHAR(255) NOT NULL,
    `present_meter_reading` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;