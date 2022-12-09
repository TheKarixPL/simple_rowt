-- simple_rowt.admin definition

CREATE TABLE `admin` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                         `login` varchar(50) NOT NULL,
                         `password` text NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `admin_UN` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- simple_rowt.employee definition

CREATE TABLE `employee` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                            `name` text NOT NULL,
                            `pin` bigint(20) unsigned NOT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- simple_rowt.admin_history definition

CREATE TABLE `admin_history` (
                                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                 `admin_id` int(10) unsigned NOT NULL,
                                 `time` datetime NOT NULL,
                                 `ip` text NOT NULL,
                                 PRIMARY KEY (`id`),
                                 KEY `admin_history_FK` (`admin_id`),
                                 CONSTRAINT `admin_history_FK` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- simple_rowt.employee_history definition

CREATE TABLE `employee_history` (
                                    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                    `employee_id` int(10) unsigned NOT NULL,
                                    `time` datetime NOT NULL,
                                    `ip` text NOT NULL,
                                    PRIMARY KEY (`id`),
                                    KEY `employee_history_FK` (`employee_id`),
                                    CONSTRAINT `employee_history_FK` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- simple_rowt.event definition

CREATE TABLE `event` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                         `employee_id` int(10) unsigned NOT NULL,
                         `type` enum('work_start','work_end','break_start','break_end') NOT NULL,
                         `time` datetime NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `event_FK` (`employee_id`),
                         CONSTRAINT `event_FK` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
