INSERT INTO `questions_types` (`type_name`, `created_at`, `updated_at`)
VALUES
    ('Múltipla escolha (RM)', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Dicotômica', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Resposta única (RU)', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Pergunta tipo matriz', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Ranking', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Pergunta de resposta aberta', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO `questions` (`type_id`, `question_number`, `question_content`, `is_optional`, `is_active`, `created_at`, `updated_at`)
VALUES
    (6, 1, 'Qual o motivo pelo qual você está procurando adotar um pet?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 2, 'Mora em casa ou apartamento? É permitido animais no imóvel?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 3, 'Já tem um local preparado para o pet dormir? Como é o local?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 4, 'Já possui outros pets? São castrados e vacinados?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 5, 'Como irá educá-lo? O que fará quando o pet não se comportar conforme o esperado?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 6, 'Tem certeza que pode arcar com os custos de alimentação, vermifugação, vacinação, castração, assistência veterinária?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 7, 'Quando for viajar o que pretende fazer com o pet? Já tem um plano?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 8, 'Alguém da família tem alergia a pêlos? O que faria se descobrir que alguém da família tem alergia?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 9, 'Todas as pessoas que moram na casa estão cientes e de acordo com a adoção?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 10, 'Tem ciência que esse animal pode crescer, envelhecer, ficar doente, e que você é responsável por prover alimentação, lar, companhia, até o fim da vida dele?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, 11, 'Tem ciência que maus-tratos contra animais podem ser punidos com reclusão, multa e proibição da guarda? O que pensa sobre isso?', 0, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO `users` (`user_id`, `name`, `email`, `phone_number`, `login`, `password`, `type`, `is_active`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Wellington Oliveira', 'woliveira0101@gmail.com', '(16) 38789-4892', 'admin', '$2y$10$moUXoUKCG9qrVguBWVfvku0C3a28vXLvbzO30IBZOpM/VKyqAhDUW', 'ambos', 1, 'admin_20240522124603.png', '2024-05-22 12:46:03', '2024-05-22 12:46:03');

INSERT INTO `pets` (`pet_id`, `pet_name`, `state`, `city`, `description`, `type`, `gender`, `breed`, `age`, `size`, `colour`, `personality`, `special_care`, `vaccinated`, `castrated`, `vermifuged`, `is_adopted`, `created_at`, `updated_at`) VALUES
(18, 'Steve Jobson', 'SP', 'Franca', 'Esse amiguinho quer muito te acompanhar nas suas aventuras.', 'cachorro', 'macho', 'Basset', 5, 'pequeno', 'Preto', 'Dócil e animado', '', 1, 1, 1, 0, '2024-05-23 10:09:23', '2024-05-23 10:09:23'),
(19, 'Marco Zuckerdog', 'SP', 'Franca', 'Companheiro fiel e protetor da família.', 'cachorro', 'macho', 'Bulldog', 6, 'medio', 'Bege e branco', 'Companheiro e amigável', 'Deficiências de Locomoção', 1, 1, 1, 0, '2024-05-23 10:13:00', '2024-05-23 10:13:00'),
(20, 'Bill Cattes', 'SP', 'Franca', 'Esse bichano é esperto, calmo e carinhoso. Ideal para casas ou apartamentos pequenos.', 'gato', 'macho', 'Shorthair', 4, 'pequeno', 'Malhado cinza', 'Esperto e carinhoso', '', 1, 0, 1, 0, '2024-05-23 10:14:20', '2024-05-23 10:14:20');

INSERT INTO `donations` (`donation_id`, `user_id`, `pet_id`, `donation_date`) VALUES
(18, 1, 18, '2024-05-23 10:09:23'),
(19, 1, 19, '2024-05-23 10:13:00'),
(20, 1, 20, '2024-05-23 10:14:20');

INSERT INTO `pet_images` (`image_id`, `pet_id`, `image`, `created_at`) VALUES
(18, 18, '18_18_20240523100923.jpg', '2024-05-23 10:09:23'),
(19, 19, '19_19_20240523101300.jpg', '2024-05-23 10:13:00'),
(20, 20, '20_20_20240523101420.jpg', '2024-05-23 10:14:20');

