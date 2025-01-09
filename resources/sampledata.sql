DELETE FROM Joueur;
DELETE FROM MatchDeRugby;

INSERT INTO Joueur (numeroLicense, nom, prenom, dateNaissance, taille, poids, statut, postePrefere, estPremiereLigne, commentaire, URL)
VALUES
-- PILIERs
(2001, 'Atonio', 'Uini', '1990-03-26', 196, 145, 'ACTIF', 'PILIER', TRUE, 'Puissance brute et PILIER expérimenté.', 'images/atonio.png'),
(2002, 'Colombe', 'Georges-Henri', '1998-04-17', 190, 125, 'ACTIF', 'PILIER', TRUE, 'Un jeune joueur en plein essor.', 'images/colombe.png'),
(2003, 'Gros', 'Jean-Baptiste', '1999-05-25', 185, 115, 'ACTIF', 'PILIER', TRUE, 'Technique et solide en mêlée.', 'images/gros.png'),
(2004, 'Tatafu', 'Tevita', '1997-11-15', 182, 118, 'ACTIF', 'PILIER', TRUE, 'Polyvalent et puissant.', 'images/tatafu.png'),
(2005, 'Wardi', 'Reda', '1995-09-16', 183, 115, 'ACTIF', 'PILIER', TRUE, 'Excellent soutien en mêlée fermée.', 'images/wardi.png'),

-- Talonneurs
(2101, 'Barlot', 'Gaëtan', '1997-07-04', 180, 102, 'ACTIF', 'TALONNEUR', TRUE, 'Très mobile avec une excellente technique.', 'images/barlot.png'),
(2102, 'Marchand', 'Julien', '1995-05-29', 178, 106, 'BLESSE', 'TALONNEUR', TRUE, 'Capitaine exemplaire et bon leader.', 'images/marchand.png'),
(2103, 'Mauvaka', 'Peato', '1997-01-10', 184, 118, 'ACTIF', 'TALONNEUR', TRUE, 'Un impact player exceptionnel.', 'images/mauvaka.png'),

-- DEUXIEME_LIGNEs
(2201, 'Flament', 'Thibaud', '1997-04-29', 200, 112, 'ACTIF', 'DEUXIEME_LIGNE', TRUE, 'Mobile et solide en touche.', 'images/flament.png'),
(2202, 'Guillard', 'Mickaël', '1998-02-17', 195, 115, 'ACTIF', 'DEUXIEME_LIGNE', TRUE, 'Fiable en touche et très physique.', 'images/guillard.png'),
(2203, 'Meafou', 'Emmanuel', '1998-07-12', 202, 140, 'ACTIF', 'DEUXIEME_LIGNE', TRUE, 'Puissant avec une grosse présence physique.', 'images/meafou.png'),
(2204, 'Taofifenua', 'Romain', '1990-09-14', 200, 140, 'ACTIF', 'DEUXIEME_LIGNE', TRUE, 'Force de la nature avec beaucoup d’expérience.', 'images/taofifenua.png'),

-- Troisième lignes Ailes
(2301, 'Boudehent', 'Paul', '1999-11-22', 193, 105, 'ACTIF', 'TROISIEME_LIGNE_AILE', FALSE, 'Plaqueur efficace et très mobile.', 'images/boudehent.png'),
(2302, 'Cros', 'François', '1994-03-25', 192, 104, 'ACTIF', 'TROISIEME_LIGNE_AILE', FALSE, 'Leader défensif et plaqueur hors pair.', 'images/cros.png'),
(2303, 'Nouchi', 'Lenni', '2001-06-15', 190, 100, 'ACTIF', 'TROISIEME_LIGNE_AILE', FALSE, 'Joueur prometteur et polyvalent.', 'images/nouchi.png'),
(2304, 'Ollivon', 'Charles', '1993-05-11', 199, 113, 'ACTIF', 'TROISIEME_LIGNE_AILE', FALSE, 'Un des leaders naturels du XV.', 'images/ollivon.png'),
(2305, 'Tixeront', 'Killian', '1998-08-22', 190, 102, 'ACTIF', 'TROISIEME_LIGNE_AILE', FALSE, 'Plaqueur et gratteur efficace.', 'images/tixeront.png'),

-- Troisième lignes CENTREs
(2401, 'Alldritt', 'Grégory', '1997-03-23', 191, 115, 'ACTIF', 'TROISIEME_LIGNE_CENTRE', FALSE, 'Puissant avec une excellente lecture de jeu.', 'images/alldritt.png'),
(2402, 'Gazzotti', 'Marko', '2004-04-08', 192, 110, 'ACTIF', 'TROISIEME_LIGNE_CENTRE', FALSE, 'Jeune joueur à fort potentiel.', 'images/gazzotti.png'),
(2403, 'Roumat', 'Alexandre', '1997-06-13', 200, 112, 'ACTIF', 'TROISIEME_LIGNE_CENTRE', FALSE, 'Très efficace en touche.', 'images/roumat.png'),

-- Demis de mêlée
(2501, 'Dupont', 'Antoine', '1996-11-15', 175, 84, 'ACTIF', 'DEMI_MELEE', FALSE, 'Le meilleur DEMI_MELEE du monde.', 'images/dupont.png'),
(2502, 'Le Garrec', 'Nolann', '2002-04-22', 180, 78, 'ACTIF', 'DEMI_MELEE', FALSE, 'Un jeune DEMI_MELEE prometteur.', 'images/legarrec.png'),
(2503, 'Lucu', 'Maxime', '1993-05-12', 177, 80, 'ACTIF', 'DEMI_MELEE', FALSE, 'Solide dans la gestion du jeu.', 'images/lucu.png'),
(2504, 'Serin', 'Baptiste', '1994-06-20', 180, 82, 'ACTIF', 'DEMI_MELEE', FALSE, 'Créatif et technique.', 'images/serin.png'),

-- Demis d’ouverture
(2601, 'Jalibert', 'Matthieu', '1998-11-06', 184, 86, 'ACTIF', 'DEMI_OUVERTURE', FALSE, 'Explosif et très bon en attaque.', 'images/jalibert.png'),

-- Centres
(2701, 'Fickou', 'Gaël', '1994-03-26', 191, 101, 'ACTIF', 'CENTRE', FALSE, 'Leader sur le terrain et très expérimenté.', 'images/fickou.png'),
(2702, 'Frisch', 'Antoine', '1996-11-04', 188, 95, 'ACTIF', 'CENTRE', FALSE, 'Polyvalent et solide.', 'images/frisch.png'),
(2703, 'Gailleton', 'Emilien', '2003-01-13', 190, 92, 'ACTIF', 'CENTRE', FALSE, 'Jeune CENTRE très prometteur.', 'images/gailleton.png'),

-- Ailiers
(2801, 'Moefana', 'Yoram', '2000-06-18', 182, 93, 'ACTIF', 'AILIER', FALSE, 'Puissant et rapide.', 'images/moefana.png'),
(2802, 'Villiere', 'Gabin', '1995-12-19', 180, 85, 'SUSPENDU', 'AILIER', FALSE, 'Connu pour son agressivité positive.', 'images/villiere.png'),

-- Arrières
(2901, 'Barré', 'Léo', '1999-07-15', 185, 85, 'ACTIF', 'ARRIERE', FALSE, 'Un joueur polyvalent et sûr sous les ballons hauts.', 'images/barre.png'),
(2902, 'Bielle-Biarrey', 'Louis', '2003-06-14', 184, 83, 'ACTIF', 'ARRIERE', FALSE, 'Un jeune joueur prometteur avec un bon jeu au pied.', 'images/bielle-biarrey.png'),
(2903, 'Buros', 'Romain', '1997-09-08', 188, 90, 'ACTIF', 'ARRIERE', FALSE, 'Excellent relanceur avec de la vitesse.', 'images/buros.png'),
(2904, 'Ramos', 'Thomas', '1995-07-23', 178, 82, 'ACTIF', 'ARRIERE', FALSE, 'Solide au pied et intelligent dans sa gestion du jeu.', 'images/ramos.png');


INSERT INTO MatchDeRugby (dateHeure, adversaire, lieu, resultat, valider)
VALUES
    ('2025-02-03 15:00:00', 'Pays de Galles', 'DOMICILE', 'VICTOIRE', TRUE),
    ('2025-02-10 17:30:00', 'Irlande', 'EXTERIEUR', NULL, FALSE),
    ('2025-03-02 16:00:00', 'Ecosse', 'DOMICILE', NULL, FALSE),
    ('2025-03-09 18:00:00', 'Angleterre', 'EXTERIEUR', NULL, FALSE),
    ('2025-03-16 20:45:00', 'Italie', 'DOMICILE', NULL, FALSE),
    ('2024-11-25 15:00:00', 'Australie', 'EXTERIEUR', 'VICTOIRE', TRUE),
    ('2024-10-30 20:00:00', 'Argentine', 'DOMICILE', 'VICTOIRE', TRUE),
    ('2024-08-15 19:00:00', 'Fidji', 'EXTERIEUR', 'VICTOIRE', TRUE);
