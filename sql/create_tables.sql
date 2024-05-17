CREATE TABLE `address`  (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL COMMENT 'FK',
  `zip_code` varchar(9) NULL,
  `street_name` varchar(70) NULL DEFAULT NULL,
  `address_number` varchar(10) NULL DEFAULT NULL,
  `address_complement` varchar(255) NULL DEFAULT NULL,
  `neighboorhood` varchar(100) NULL DEFAULT NULL,
  `city_name` varchar(100) NOT NULL,
  `state_name` varchar(2) NULL DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci;

CREATE TABLE `adoptions`  (
  `adoption_id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'FK',
  `pet_id` int NOT NULL COMMENT 'FK',
  `adoption_date` datetime NULL,
  `status` enum('aprovado','reprovado','em analise') NULL DEFAULT 'em analise',
  PRIMARY KEY (`adoption_id`)
) ENGINE = MyISAM CHARACTER SET = utf8;

CREATE TABLE `donations`  (
  `donation_id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'FK',
  `pet_id` int NOT NULL COMMENT 'FK',
  `donation_date` datetime NULL,
  PRIMARY KEY (`donation_id`)
) ENGINE = MyISAM CHARACTER SET = utf8;

CREATE TABLE `form_questions`  (
  `question_id` int NOT NULL AUTO_INCREMENT,
  `adoption_id` int NOT NULL COMMENT 'FK',
  `question_content` varchar(100) NOT NULL,
  `question_number` int NOT NULL,
  `question_type` varchar(30) NULL DEFAULT NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`)
) ENGINE = MyISAM CHARACTER SET = utf8;

CREATE TABLE `pet_images`  (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `pet_id` int NOT NULL COMMENT 'FK',
  `image` varchar(255) NULL,
  `created_at` datetime NULL,
  PRIMARY KEY (`image_id`)
) ENGINE = MyISAM CHARACTER SET = utf8;

CREATE TABLE `pets`  (
  `pet_id` int NOT NULL AUTO_INCREMENT,
  `pet_name` varchar(50) NOT NULL,
  `state` varchar(2) NULL,
  `city` varchar(100) NULL,
  `description` varchar(255) NOT NULL,
  `type` enum('cachorro','gato','outro') NOT NULL,
  `gender` enum('macho','femea','nao sei') NOT NULL,
  `breed` varchar(20) NULL DEFAULT NULL,
  `age` smallint NOT NULL,
  `size` enum('pequeno','medio','grande') NULL DEFAULT NULL,
  `colour` varchar(20) NULL DEFAULT NULL,
  `personality` varchar(50) NULL DEFAULT NULL,
  `special_care` varchar(100) NULL DEFAULT NULL,
  `vaccinated` boolean NULL DEFAULT NULL,
  `castrated` boolean NULL DEFAULT NULL,
  `vermifuged` boolean NULL DEFAULT NULL,
  `is_adopted` boolean NULL DEFAULT NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pet_id`)
) ENGINE = MyISAM CHARACTER SET = utf8;

CREATE TABLE `question_answers`  (
  `answer_id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL COMMENT 'FK',
  `answer_content` text NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE = MyISAM CHARACTER SET = utf8;

CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `type` enum('doador','adotante','ambos') NULL DEFAULT NULL,
  `is_active` boolean NULL DEFAULT NULL,
  `image` varchar(255) NULL DEFAULT NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE = MyISAM CHARACTER SET = utf8;

ALTER TABLE `address` ADD CONSTRAINT `fk_address_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
ALTER TABLE `adoptions` ADD CONSTRAINT `fk_adoptions_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
ALTER TABLE `adoptions` ADD CONSTRAINT `fk_adoptions_pets` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE;
ALTER TABLE `donations` ADD CONSTRAINT `fk_donors_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
ALTER TABLE `donations` ADD CONSTRAINT `fk_donors_pets` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`) ON DELETE CASCADE;
ALTER TABLE `form_questions` ADD CONSTRAINT `fk_questions_adoptions` FOREIGN KEY (`adoption_id`) REFERENCES `adoptions` (`adoption_id`) ON DELETE CASCADE;
ALTER TABLE `pet_images` ADD CONSTRAINT `fk_image_pet` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`) ON DELETE CASCADE;
ALTER TABLE `question_answers` ADD CONSTRAINT `fk_answers_questions` FOREIGN KEY (`answer_id`) REFERENCES `form_questions` (`question_id`) ON DELETE CASCADE;

