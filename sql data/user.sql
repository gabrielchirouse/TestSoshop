INSERT INTO api.user (id, name, surname, email, phone, birthday, deletion_date) VALUES (1, 'Daniel', 'Ricciardo', 'honey.badger@fia.com', '', '1989-07-01', null);
INSERT INTO api.user (id, name, surname, email, phone, birthday, deletion_date) VALUES (2, 'Pierre', 'Gasly', 'pierrot-monza2020@fia.com', '', '1996-02-07', null);
INSERT INTO api.user (id, name, surname, email, phone, birthday, deletion_date) VALUES (3, 'Sebastian', 'Vettel', 'babyschumy@fia.com', '', '1987-07-03', null);
INSERT INTO api.user (id, name, surname, email, phone, birthday, deletion_date) VALUES (4, 'Fernando', 'Alonso', 'nando@fia.com', '', '1981-07-29', null);
INSERT INTO api.user (id, name, surname, email, phone, birthday, deletion_date) VALUES (5, 'Norris', 'Lando', 'nono@fia.com', '', '1989-11-13', null);
INSERT INTO api.user (id, name, surname, email, phone, birthday, deletion_date) VALUES (6, 'Romain', 'Grosjean', 'r8g@fia.com', '', '1986-04-17', '2021-08-20');

INSERT INTO api.card_bank (id, number, deletion_date, expiry_date, status) VALUES (1, 5577000055770004, null, '2023-08-20', 'active');
INSERT INTO api.card_bank (id, number, deletion_date, expiry_date, status) VALUES (2, 5555444433331111, null, '2023-08-20', 'active');
INSERT INTO api.card_bank (id, number, deletion_date, expiry_date, status) VALUES (3, 2222410740360010, null, '2023-08-20', 'active');
INSERT INTO api.card_bank (id, number, deletion_date, expiry_date, status) VALUES (4, 2222410740360010, null, '2023-08-20', 'active');
INSERT INTO api.card_bank (id, number, deletion_date, expiry_date, status) VALUES (5, 2222410740360010, null, '2023-08-20', 'active');
INSERT INTO api.card_bank (id, number, deletion_date, expiry_date, status) VALUES (6, 2222410740360010, null, '2023-08-20', 'active');
INSERT INTO api.card_bank (id, number, deletion_date, expiry_date, status) VALUES (7, 2222410740360010, '2021-08-20', '2023-08-20', 'fermée');

INSERT INTO api.account_bank (id, iban, bic, balance, card_bank_id, user_id, deletion_date) VALUES (1, 'FR76 1234 1234 1234', 'AFRIFRPP', 326.46, 1, 1, null);
INSERT INTO api.account_bank (id, iban, bic, balance, card_bank_id, user_id, deletion_date) VALUES (2, 'FR43 1234 1234 1940', 'BAMYFR22', -12.4, 2, 1, null);
INSERT INTO api.account_bank (id, iban, bic, balance, card_bank_id, user_id, deletion_date) VALUES (3, 'FR76 1234 1234 4567', 'AGRIFRPP', 1811, 3, 2, null);
INSERT INTO api.account_bank (id, iban, bic, balance, card_bank_id, user_id, deletion_date) VALUES (4, 'FR76 1234 1234 0987', 'AGRIRERX', 23.67, 4, 3, null);
INSERT INTO api.account_bank (id, iban, bic, balance, card_bank_id, user_id, deletion_date) VALUES (5, 'FR76 1234 1234 1236', 'ARCEFRP1', 567, 5, 4, null);
INSERT INTO api.account_bank (id, iban, bic, balance, card_bank_id, user_id, deletion_date) VALUES (6, 'FR76 1234 1234 8759', 'AUDIFRPP', 1.34, 6, 5, null);
INSERT INTO api.account_bank (id, iban, bic, balance, card_bank_id, user_id, deletion_date) VALUES (7, 'FR74 1234 1234 9876', 'AXABFRPP', 875.23, 7, 6, '2021-08-20');
