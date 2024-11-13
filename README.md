# Atelier Doxygen

Ce dépôt contient un code source de départ que vous pouvez utiliser pour l'atelier dédié à la documentation de code avec Doxygen. L'objectif de cet atelier est de fournir une introduction complète à Doxygen, un outil de documentation automatique pour les projets logiciels.


## Installation

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/patrick-etcheverry/atelier-doxygen.git
   ```

2. **Ré-générer les librairies nécessaires :**
   ```bash
   cd atelier-doxygen
   ```

   ```bash
   composer install
   ```

   ```bash
   npm install
   ```

3. **Déployer la base de données :**
Cette étape n'est pas nécessaire pour réaliser l'atelier mais si vous souhaitez déployer l'application Yabontiap :
- Créez une BD nommée `yabontiap_bd` sur votre serveur de base de donées
-   Importez le fichier `yabontiap_bd.sql`
-   Editez le fichier `config/constantes.php` pour renseigner les informations de connexion à votre base de données `yabontiap_bd`
