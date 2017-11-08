INSERT INTO Rights (`rights`, `text`) VALUES(0, '');
INSERT INTO Rights (`rights`, `text`) VALUES(1, 'Membre');
INSERT INTO Rights (`rights`, `text`) VALUES(2, 'Bureau');
INSERT INTO Rights (`rights`, `text`) VALUES(4, 'Président(e)');

INSERT INTO User (`firstName`, `lastName`, `born`, `rights`) VALUES('Pierre', 'Leroy', '1996-12-07', 2);
INSERT INTO User (`firstName`, `lastName`, `born`, `rights`) VALUES('Test', 'Test', '1996-12-07', 1);

INSERT INTO Event (`creator`,`title`,`start`,`end`,`description`,`price`) VALUES(1, 'Event Test', '2017-12-25 19:00:00', '2017-12-26 02:00:00', "En fait Noel", 15);
INSERT INTO Event (`creator`,`title`,`start`,`end`,`description`,`price`) VALUES(2, 'Event Test 2', '2017-12-25 19:00:00', '2017-12-26 02:00:00', "En fait Noel Encore !!", 150);
