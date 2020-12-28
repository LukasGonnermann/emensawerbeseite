CREATE DATABASE emensawerbeseite;
USE emensawerbeseite;
create table gericht
(
    id           bigint PRIMARY KEY,
    name         varchar(80)  not null unique,
    beschreibung varchar(800) not null,
    erfasst_am   date         not null,
    vegetarisch  boolean      not null DEFAULT false,
    vegan        boolean      not null DEFAULT false,
    preis_intern double       not null,
    preis_extern double check ( preis_extern >= preis_intern )
);

create table allergen
(
    code char(4) PRIMARY KEY,
    name varchar(300) not null,
    typ  varchar(20)  not null default 'allergen'
);
create table kategorie
(
    id        bigint PRIMARY KEY,
    name      varchar(80) not null,
    eltern_id bigint,
    bildname  varchar(200)
);
create table gericht_hat_allergen
(
    code       char(4) references allergen (code),
    gericht_id bigint not null references gericht (id)
);
create table gericht_hat_kategorie
(
    gericht_id   bigint not null references gericht (id),
    kategorie_id bigint not null references kategorie (id)
);

-- SET NAMES utf8mb4;

USE emensawerbeseite;

INSERT INTO `allergen` (`code`, `name`, `typ`)
VALUES ('a', 'Getreideprodukte', 'Getreide (Gluten)'),
       ('a1', 'Weizen', 'Allergen'),
       ('a2', 'Roggen', 'Allergen'),
       ('a3', 'Gerste', 'Allergen'),
       ('a4', 'Dinkel', 'Allergen'),
       ('a5', 'Hafer', 'Allergen'),
       ('a6', 'Dinkel', 'Allergen'),
       ('b', 'Fisch', 'Allergen'),
       ('c', 'Krebstiere', 'Allergen'),
       ('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
       ('e', 'Sellerie', 'Allergen'),
       ('f', 'Milch und Laktose', 'Allergen'),
       ('f1', 'Butter', 'Allergen'),
       ('f2', 'Käse', 'Allergen'),
       ('f3', 'Margarine', 'Allergen'),
       ('g', 'Sesam', 'Allergen'),
       ('h', 'Nüsse', 'Allergen'),
       ('h1', 'Mandeln', 'Allergen'),
       ('h2', 'Haselnüsse', 'Allergen'),
       ('h3', 'Walnüsse', 'Allergen'),
       ('i', 'Erdnüsse', 'Allergen');

INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegan`, `vegetarisch`, `preis_intern`,
                       `preis_extern`)
VALUES (1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2.3,
        4),
       (3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2.3, 4),
       (4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5),
       (5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5),
       (6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 0, 1, 2.5, 4.5),
       (7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4),
       (8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4),
       (9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5),
       (10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5),
       (11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 0, 1, 2, 3),
       (12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2),
       (13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 0, 1, 2.5, 4.5),
       (14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 0, 1, 3, 5),
       (15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5),
       (16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 0, 1, 1, 1.5),
       (17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75),
       (18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5),
       (19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 0, 1, 1.25, 1.75),
       (20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9);

INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`)
VALUES ('h', 1),
       ('a3', 1),
       ('a4', 1),
       ('f1', 3),
       ('a6', 3),
       ('i', 3),
       ('a3', 4),
       ('f1', 4),
       ('a4', 4),
       ('h3', 4),
       ('d', 6),
       ('h1', 7),
       ('a2', 7),
       ('h3', 7),
       ('c', 7),
       ('a3', 8),
       ('h3', 10),
       ('d', 10),
       ('f', 10),
       ('f2', 12),
       ('h1', 12),
       ('a5', 12),
       ('c', 1),
       ('a2', 9),
       ('i', 14),
       ('f1', 1),
       ('a1', 15),
       ('a4', 15),
       ('i', 15),
       ('f3', 15),
       ('h3', 15);

INSERT INTO `kategorie` (`id`, `eltern_id`, `name`, `bildname`)
VALUES (1, NULL, 'Aktionen', 'kat_aktionen.png'),
       (2, NULL, 'Menus', 'kat_menu.gif'),
       (3, 2, 'Hauptspeisen', 'kat_menu_haupt.bmp'),
       (4, 2, 'Vorspeisen', 'kat_menu_vor.svg'),
       (5, 2, 'Desserts', 'kat_menu_dessert.pic'),
       (6, 1, 'Mensastars', 'kat_stars.tif'),
       (7, 1, 'Erstiewoche', 'kat_erties.jpg');

INSERT INTO `gericht_hat_kategorie` (`kategorie_id`, `gericht_id`)
VALUES (3, 1),
       (3, 3),
       (3, 4),
       (3, 5),
       (3, 6),
       (3, 7),
       (3, 9),
       (4, 16),
       (4, 17),
       (4, 18),
       (5, 16),
       (5, 17),
       (5, 18);

CREATE TABLE wunschgericht
(
    wid          INTEGER PRIMARY KEY AUTO_INCREMENT,
    name         varchar(40) not null,
    beschreibung varchar(400) not null,
    erstellt_am  datetime not null DEFAULT (NOW())
);

CREATE TABLE ersteller
(
    eid   INTEGER PRIMARY KEY AUTO_INCREMENT,
    name  varchar(40) not null default ('anonym'),
    email varchar(40) not null
);

CREATE TABLE wunschgericht_hat_ersteller
(
    wid INTEGER REFERENCES wunschgericht(wid),
    eid INTEGER REFERENCES ersteller(eid)
);

#1
CREATE UNIQUE INDEX idx_gericht_kategorie ON gericht_hat_kategorie(gericht_id, kategorie_id);

#2
CREATE UNIQUE INDEX idx_name ON gericht(name);

#3
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT gericht_hat_kategorie_fk_1
        FOREIGN KEY (gericht_id)
            REFERENCES gericht (id) ON DELETE CASCADE ON UPDATE RESTRICT,
    ADD CONSTRAINT gericht_hat_kategorie_fk_2
        FOREIGN KEY (kategorie_id)
            REFERENCES kategorie (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE gericht_hat_allergen
    ADD CONSTRAINT gericht_hat_allergen_fk_1
        FOREIGN KEY (code)
            REFERENCES allergen (code) ON DELETE CASCADE ON UPDATE RESTRICT,
    ADD CONSTRAINT gericht_hat_allergen_fk_2
        FOREIGN KEY (gericht_id)
            REFERENCES gericht (id) ON DELETE CASCADE ON UPDATE RESTRICT;

#4
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT gericht_hat_kategorie_fk_3
        FOREIGN KEY (kategorie_id)
            REFERENCES kategorie (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE kategorie
    ADD CONSTRAINT eltern_id
        FOREIGN KEY (`eltern_id`)
            REFERENCES kategorie (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

#5
ALTER TABLE gericht_hat_allergen
    ADD CONSTRAINT gericht_hat_allergen_fk_3
        FOREIGN KEY (`code`)
            REFERENCES allergen (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

#6
ALTER TABLE gericht_hat_kategorie
    ADD PRIMARY KEY (`gericht_id`, `kategorie_id`);

create table benutzer
(
    id bigint auto_increment
        primary key,
    email varchar(100) not null,
    passwort varchar(200) not null,
    admin tinyint(1) default 0 null,
    anzahlfehler int default 0 not null,
    anzahlanmeldungen int not null,
    letzteanmeldung datetime null,
    letzterfehler datetime null,
    constraint email
        unique (email)
);

ALTER TABLE gericht
    ADD bildname varchar(200) default null;

start transaction ;
UPDATE gericht SET bildname='01_bratkartoffel.jpg' where id='1';
UPDATE gericht SET bildname='03_bratkartoffel.jpg' where id='3';
UPDATE gericht SET bildname='06_lasagne.jpg' where id='6';
UPDATE gericht SET bildname='10_forelle.jpg'where id='10';
UPDATE gericht SET bildname='11_soup.jpg' where id='11';
UPDATE gericht SET bildname='12_kassler.jpg' where id='12';
UPDATE gericht SET bildname='13_reibekuchen.jpg' where id='13';
UPDATE gericht SET bildname='15_pilze.jpg' where id='15';
UPDATE gericht SET bildname='17_broetchen.jpg' where id='17';
UPDATE gericht SET bildname='19_mousse.jpg' where id='19';
UPDATE gericht SET bildname='20_suppe.jpg'where id='20';

UPDATE gericht SET bildname='00_image_missing.jpg' where id='4';
UPDATE gericht SET bildname='00_image_missing.jpg'where id='5';
UPDATE gericht SET bildname='00_image_missing.jpg'where id='7';
UPDATE gericht SET bildname='00_image_missing.jpg' where id='8';
UPDATE gericht SET bildname='00_image_missing.jpg'where id='9';
UPDATE gericht SET bildname='00_image_missing.jpg'where id='14';
UPDATE gericht SET bildname='00_image_missing.jpg' where id='16';
UPDATE gericht SET bildname='00_image_missing.jpg'where id='18';
commit ;

