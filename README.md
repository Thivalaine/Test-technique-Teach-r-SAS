# Test-technique-Teach-r-SAS
Test technique - Développeur full-stack - Juin 2022

### Pour démarrer ou mettre en place le démarrage de l'application

Commencez par installer NodeJS sur votre poste pour pouvoir effectuer des commandes "npm" ou "yarn" sur un invite de commandes :

- Lien de Node.Js : https://nodejs.org/fr/

Pour simuler un smartphone en Android, installer Android Studio puis aller sur "More Actions" --> "Virtual Device Manager" --> "Create Device" pour créer un émulateur Android

Commencez par initialiser l'application en installant yarn :

	yarn install

### Lors du lancement de la commande ci-dessus, si vous rencontrez des problèmes :

Par exemple : "adb reverse", lancez cette commande :

	set ANDROID_HOME=c:/Users/VOTRE_NOM_D'UTILISATEUR/AppData/Local/Android/Sdk

Pour le problème de SDK non reconnu, il faut créer un fichier texte "local.properties", le placer dans le fichier de votre application mobile "mobile/android/" puis coller ceci :

	sdk.dir = C\:\\Users\\VOTRE_NOM_D'UTILISATEUR\\AppData\\Local\\Android\\Sdk

Et pour le dernier problème du BatchedBridge, faites :

Eteignez votre application :

	npm cache clean --force

ou bien

	react-native start --reset-cache

puis relancer :

	react-native run-android

### Pour démarrer l'application Symfony

Installer les packages de Composer :

	composer install

Créer la base de données :

	php bin/console doctrine:database:create

Implémenter les tables :

	php bin/console doctrine:schema:update --force

Insérer les jeux d'essais :

	php bin/console doctrine:fixtures:load 

Pour accéder à la page de l'application :

	http://localhost:8000

