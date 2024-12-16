# Application de Réservation (Restaurant, Hôtel, etc.)

Cette application permet aux utilisateurs de réserver des services tels que des tables de restaurant, des chambres d'hôtel, ou d'autres services. Les administrateurs peuvent gérer les utilisateurs, les réservations, et les services disponibles.

## Table des matières
- [Description](#description)
- [Fonctionnalités](#fonctionnalités)
- [Technologies utilisées](#technologies-utilisées)
- [Installation](#installation)
- [Structure de la base de données](#structure-de-la-base-de-données)
- [Exemples de données](#exemples-de-données)
- [Contributeurs](#contributeurs)
- [Licence](#licence)

## Description

L'application permet aux utilisateurs de :
- Créer un compte et se connecter.
- Réserver une table ou une chambre selon les créneaux horaires disponibles.
- Gérer leurs réservations : annuler ou modifier.
- Recevoir une confirmation de réservation par email.

Les administrateurs ont accès à un tableau de bord pour :
- Gérer les utilisateurs (CRUD).
- Voir les statistiques des réservations.
- Ajouter, modifier ou supprimer des services et des créneaux horaires.

## Fonctionnalités

### Utilisateur (Client)
- Inscription et authentification des utilisateurs.
- Réservation de services (tables, chambres, etc.).
- Visualisation des créneaux horaires disponibles.
- Modification ou annulation des réservations.
- Confirmation par email de chaque réservation.

### Administrateur
- Gestion des utilisateurs : création, modification, suppression.
- Validation des comptes utilisateurs.
- Gestion des services : ajout, modification, suppression.
- Gestion des créneaux horaires disponibles pour chaque service.

## Technologies utilisées

- **Front-end** : HTML, CSS, JavaScript (avec validation côté client)
- **Back-end** : PHP (pour la gestion des utilisateurs, réservations, services et créneaux)
- **Base de données** : MySQL
- **Sécurité** : Utilisation de `bcrypt` pour le hachage des mots de passe, protection contre les attaques XSS et CSRF.

## Installation

### Prérequis

- Serveur web (par exemple, Apache ou Nginx)
- PHP 7.4 ou supérieur
- MySQL ou MariaDB
- Composer (si vous souhaitez installer des dépendances PHP)
- Outils de gestion des bases de données comme phpMyAdmin ou MySQL Workbench

### Étapes d'installation

1. Clonez ce dépôt sur votre machine locale :

   ```bash
   git clone https://github.com/votre-utilisateur/application-de-reservation.git
   Accédez au dossier du projet :

Copier le code
cd application-de-reservation
-- Exemple de création de base de données
CREATE DATABASE reservation_db;
USE reservation_db;
-- Importez le fichier SQL pour les tables
SOURCE database/schema.sql;
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'reservation_db');
?>
Si nécessaire, installez les dépendances PHP avec Composer (si vous utilisez des bibliothèques externes).

Déployez le projet sur votre serveur web et assurez-vous que le serveur Apache ou Nginx est configuré pour pointer vers le répertoire du projet.

Accédez à l'application via le navigateur à l'adresse de votre serveur local ou distant.

Structure de la base de données
Voici un aperçu des principales tables utilisées dans l'application :

roles : Contient les rôles des utilisateurs (admin, user).
users : Contient les informations des utilisateurs (nom, email, mot de passe, etc.).
services : Contient les services disponibles pour réservation (restaurant, hôtel, etc.).
reservations : Contient les réservations faites par les utilisateurs.
available_slots : Contient les créneaux horaires disponibles pour chaque service.
Le script SQL pour créer ces tables est inclus dans le fichier database/schema.sql.

Exemples de données
Voici quelques exemples de données pour tester l'application :

Rôles

INSERT INTO roles (name, description) VALUES
('user', 'Client normal'),
('admin', 'Administrateur système');
Utilisateurs

INSERT INTO users (role_id, name, email, password) VALUES
(1, 'Alice', 'alice@example.com', 'hashed_password_1'),
(2, 'Bob', 'bob@example.com', 'hashed_password_2');
Services

INSERT INTO services (name, description, price) VALUES
('Table pour 2 personnes', 'Table pour deux personnes dans le restaurant', 20.00),
('Chambre simple', 'Chambre avec un lit simple dans l\'hôtel', 50.00);
Créneaux disponibles
INSERT INTO available_slots (service_id, slot_time, is_booked) VALUES
(1, '2024-12-20 18:00:00', FALSE),
(1, '2024-12-20 20:00:00', FALSE),
(2, '2024-12-20 14:00:00', FALSE);
Réservations
INSERT INTO reservations (user_id, service_id, reservation_time, status) VALUES
(1, 1, '2024-12-20 18:00:00', 'pending'),
(2, 2, '2024-12-20 14:00:00', 'confirmed');
Contributeurs
Alice Dupont - Développeuse back-end et front-end
Bob Martin - Responsable de la base de données et sécurité
Si vous souhaitez contribuer à ce projet, merci de soumettre une demande de tirage (pull request) ou d'ouvrir un problème (issue) pour toute suggestion d'amélioration.

Licence
Ce projet est sous licence MIT. Consultez le fichier LICENSE pour plus de détails.


### Explications des sections :

1. **Description** : Explique brièvement l'objectif de l'application.
2. **Fonctionnalités** : Liste les principales fonctionnalités de l'application, tant pour les utilisateurs que pour les administrateurs.
3. **Technologies utilisées** : Présente les technologies principales (PHP, MySQL, etc.).
4. **Installation** : Détaille les étapes d'installation et les prérequis pour faire fonctionner l'application.
5. **Structure de la base de données** : Donne une vue d'ensemble des principales tables et de leurs relations.
6. **Exemples de données** : Fournit des exemples pour insérer des données de test dans la base de données.
7. **Contributeurs** : Liste des personnes ayant contribué au projet.
8. **Licence** : Précise la licence du projet.
