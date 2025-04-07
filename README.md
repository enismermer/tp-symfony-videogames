# VideoGames

*VideoGames* est une application Symfony permettant de gérer une collection de jeux vidéo, en particulier pour la Nintendo 64. Cette application permet de visualiser, ajouter et modifier des jeux de la collection.

## Routes disponibles

- **/** : Page d'accueil
- **/games** : Liste tous les jeux vidéo de la collection
- **/game/{id}** : Affiche les détails d'un jeu vidéo spécifique
- **/game/create** : Formulaire pour ajouter un nouveau jeu vidéo
- **/game/{id}/edit** : Formulaire pour modifier un jeu vidéo existant

## Fonctionnalités

- **Gestion des jeux vidéo** : Ajout, modification des jeux vidéo dans la collection
- **Affichage des jeux vidéo** : Liste de tous les jeux vidéo enregistrés (pagination avec KnpPaginatorBundle)
- **Détails sur chaque jeu vidéo** : Informations complètes sur chaque jeu (titre, description, date de sortie, etc.)
- **Formulaires interactifs** : Validation des formulaires pour l'ajout et la modification des jeux
- **Données de test (fixtures)** : Import de jeux Nintendo 64 via DoctrineFixturesBundle pour peupler la base de données avec des exemples réalistes

## Installation

Pour installer et démarrer le projet, suivez les étapes suivantes :

1. Clonez le repository :
   ```bash
   git clone <url-du-repository>
   ```

2. Installez les dépendances via Composer :
    ```bash
    composer install
    ```

3. Créez la base de données :

    ```bash
    php bin/console doctrine:database:create
    ```

4. Appliquez les migrations :

    ```bash
    php bin/console doctrine:migrations:migrate
    ```

5. Lancez le serveur de développement :

    ```bash
    symfony server:start
    ```

Le projet sera accessible sur http://127.0.0.1:8000 ou l'URL fournie par le serveur.