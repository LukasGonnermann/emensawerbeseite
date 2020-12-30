CREATE VIEW Suppen_Gerichte AS
SELECT name
        FROM emensawerbeseite.gericht
        WHERE name LIKE '%suppe%' or name LIKE '%Suppe%';

CREATE VIEW view_anmeldungen AS
SELECT anzahlanmeldungen
FROM emensawerbeseite.benutzer
ORDER BY anzahlanmeldungen DESC ;

CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT name , kategorie_id
FROM emensawerbeseite.gericht, emensawerbeseite.gericht_hat_kategorie
WHERE vegetarisch = 1  ;




