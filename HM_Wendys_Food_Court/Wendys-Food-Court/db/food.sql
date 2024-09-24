CREATE TABLE `wendys food court`.`food`
(`food_id` INT NOT NULL ,
`name` VARCHAR(150) NOT NULL ,
`description` TEXT NOT NULL ,
`price` DOUBLE NOT NULL ,
`category` VARCHAR(50) NOT NULL ,
`availability` BOOLEAN NOT NULL ,
`image` BLOB NOT NULL ,
PRIMARY KEY (`food_id`)) ENGINE = InnoDB;