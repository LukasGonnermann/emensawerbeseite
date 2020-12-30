CREATE VIEW Suppen_Gerichte AS
SELECT *
        FROM emensawerbeseite.gericht
        WHERE name LIKE '%suppe%' or name LIKE '%Suppe%';

CREATE VIEW view_anmeldungen AS
SELECT *
FROM emensawerbeseite.benutzer
ORDER BY anzahlanmeldungen DESC ;

CREATE VIEW view_kategoriegerichte_vegetarisch AS SELECT DISTINCT emensawerbeseite.gericht.name AS gerichtname ,
GROUP_CONCAT(emensawerbeseite.kategorie.name) AS Kategorie
FROM emensawerbeseite.gericht LEFT JOIN emensawerbeseite.gericht_hat_kategorie on emensawerbeseite.gericht.id = gericht_hat_kategorie.gericht_id
LEFT JOIN emensawerbeseite.kategorie ON gericht_hat_kategorie.kategorie_id = emensawerbeseite.kategorie.id
WHERE gericht.vegetarisch =1
GROUP BY gericht.name;




