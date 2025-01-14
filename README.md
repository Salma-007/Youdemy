# Youdemy - Plateforme de Cours en Ligne

**Youdemy** est une plateforme de cours en ligne interactive et personnalisée, visant à révolutionner l'apprentissage. Elle permet aux étudiants de suivre des cours et aux enseignants de créer et gérer des contenus éducatifs, tout en garantissant un système de gestion des utilisateurs fiable et sécurisé.

## Fonctionnalités

### 1. **Partie Front Office** :

#### **Visiteur** :
- Accès au catalogue des cours avec pagination.
- Recherche de cours par mots-clés.
- Création d’un compte avec le choix du rôle (Étudiant ou Enseignant).

#### **Étudiant** :
- Visualisation du catalogue des cours.
- Recherche et consultation des détails des cours (description, contenu, enseignant, etc.).
- Inscription à un cours après authentification.
- Accès à une section “Mes cours” regroupant les cours rejoints.

#### **Enseignant** :
- Ajout de nouveaux cours avec des détails comme :
  - Titre, description, contenu (vidéo ou document), tags, catégorie.
- Gestion des cours : Modification, suppression et consultation des inscriptions.
- Accès à une section “Statistiques” sur les cours (Nombre d’étudiants inscrits, Nombre de cours, etc.).

### 2. **Partie Back Office** :

#### **Administrateur** :
- Validation des comptes enseignants.
- Gestion des utilisateurs : Activation, suspension ou suppression.
- Gestion des contenus : Cours, catégories et tags.
- Insertion en masse de tags pour gagner en efficacité.
- Accès à des statistiques globales :
  - Nombre total de cours, répartition par catégorie.
  - Le cours avec le plus d'étudiants.
  - Top 3 des enseignants.

### 3. **Fonctionnalités Transversales** :
- Un cours peut contenir plusieurs tags (relation many-to-many).
- Application du concept de polymorphisme dans les méthodes suivantes :
  - Ajouter un cours.
  - Afficher un cours.
- Système d’authentification et d’autorisation pour protéger les routes sensibles.
- Contrôle d’accès : Chaque utilisateur ne peut accéder qu’aux fonctionnalités correspondant à son rôle.

### Utilisation

- En tant qu'Étudiant : Créez un compte, explorez les cours disponibles et inscrivez-vous à ceux qui vous intéressent.
- En tant qu'Enseignant : Ajoutez de nouveaux cours, gérez les inscriptions et consultez les statistiques.
- En tant qu'Administrateur : Validez les comptes enseignants, gérez les utilisateurs et consultez les statistiques globales.
Contributions

## Exigences Techniques

- Respect des principes OOP (Object-Oriented Programming) : encapsulation, héritage, polymorphisme.
- Base de données relationnelle avec gestion des relations (one-to-many, many-to-many).
- Utilisation des sessions PHP pour la gestion des utilisateurs connectés.
- Validation des données utilisateur pour garantir la sécurité.
  
## Technologies Utilisées

- **Frontend** : HTML, CSS, JavaScript
- **Backend** : PHP (avec gestion des sessions)
- **Base de données** : MySQL (pour la gestion des utilisateurs, des cours et des catégories)
- **Outils de développement** : Composer (pour la gestion des dépendances PHP)


## Prérequis

- PHP 7.4 ou supérieur
- Serveur Web (Apache, Nginx)
- MySQL 
- Composer 


