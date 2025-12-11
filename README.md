
## 🛠️ Installation & Configuration

### 1️⃣ Cloner le projet

```bash
git clone https://github.com/ton-compte/ambulance-management.git
cd ambulance-management

2️⃣ Installer les dépendances PHP
composer install

3️⃣ Configurer l’environnement

Créer un fichier .env.local :

APP_ENV=dev
APP_DEBUG=1

DATABASE_URL="mysql://USERNAME:PASSWORD@127.0.0.1:3306/BDD?serverVersion=8.0"

4️⃣ Créer la base de données
php bin/console doctrine:database:create

5️⃣ Lancer les migrations Doctrine
php bin/console make:migration
php bin/console doctrine:migrations:migrate

6️⃣ Lancer le serveur Symfony
symfony server:start
