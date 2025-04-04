<p align="center"><a href="#" target="_blank"><img src="https://via.placeholder.com/400x150.png?text=Traverse+Ta+Rue" width="400" alt="Traverse Ta Rue Logo"></a></p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/build-passing-brightgreen" alt="Build Status"></a>
<a href="#"><img src="https://img.shields.io/badge/license-MIT-blue" alt="License"></a>
</p>

# Traverse Ta Rue

**English** | [Français](#français)

## About Traverse Ta Rue

Traverse Ta Rue is a web application designed to help users find internships efficiently. The platform provides tools for managing internship listings, creating wishlists, and handling administrative tasks. Built with modern web technologies, it ensures a seamless and user-friendly experience.

### Features

- **CRUD Operations**: Create, Read, Update, and Delete internship listings.
- **Wishlist**: Save and manage your favorite internship opportunities.
- **Admin Management**: Manage users, internships, and platform settings.
- **User Authentication**: Secure login and registration system.
- **Responsive Design**: Optimized for both desktop and mobile devices.

## Getting Started

### Prerequisites

- PHP 8.0 or higher
- Composer
- Node.js and npm
- A web server (e.g., Apache, Nginx)
- A database (e.g., MySQL, PostgreSQL)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/traverse-ta-rue.git
   cd traverse-ta-rue
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Set up the database:
   ```bash
   php artisan migrate --seed
   ```

5. Start the development server:
   ```bash
   php artisan serve
   npm run dev
   ```

6. Access the application at `http://localhost:8000`.

## Contributing

We welcome contributions! Please read our [contribution guide](CONTRIBUTING.md) for details on how to get started.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

# Français

## À propos de Traverse Ta Rue

Traverse Ta Rue est une application web conçue pour aider les utilisateurs à trouver des stages efficacement. La plateforme offre des outils pour gérer les offres de stage, créer des listes de souhaits et gérer les tâches administratives. Construite avec des technologies web modernes, elle garantit une expérience fluide et conviviale.

### Fonctionnalités

- **Opérations CRUD** : Créer, Lire, Mettre à jour et Supprimer des offres de stage.
- **Liste de souhaits** : Enregistrez et gérez vos opportunités de stage préférées.
- **Gestion administrative** : Gérez les utilisateurs, les stages et les paramètres de la plateforme.
- **Authentification utilisateur** : Système sécurisé de connexion et d'inscription.
- **Design réactif** : Optimisé pour les ordinateurs de bureau et les appareils mobiles.

## Démarrage

### Prérequis

- PHP 8.0 ou supérieur
- Composer
- Node.js et npm
- Un serveur web (ex. : Apache, Nginx)
- Une base de données (ex. : MySQL, PostgreSQL)

### Installation

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/your-repo/traverse-ta-rue.git
   cd traverse-ta-rue
   ```

2. Installez les dépendances :
   ```bash
   composer install
   npm install
   ```

3. Configurez l'environnement :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configurez la base de données :
   ```bash
   php artisan migrate --seed
   ```

5. Lancez le serveur de développement :
   ```bash
   php artisan serve
   npm run dev
   ```

6. Accédez à l'application à `http://localhost:8000`.

## Contribuer

Les contributions sont les bienvenues ! Veuillez lire notre [guide de contribution](CONTRIBUTING.md) pour savoir comment commencer.

## Licence

Ce projet est un logiciel open source sous licence [MIT](https://opensource.org/licenses/MIT).
