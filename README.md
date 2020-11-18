## Pour l'installation du projet

1. Cloner le projet sur votre machine : `git clone  https://github.com/tontonlouis/Symf5VisioGit.git`
1. Modifier le `.env.default` en `.env` avec vos paramètre BDD
1. Installez les dépendances : `composer update`
1. Créez votre BDD : `php bin/console d:d:c`
1. Jouez les migrations : `php bin/console d:m:m`
1. Jouez les fixtures : `php bin/console d:f:l --no-interaction`
1. Intallez les librairies NodeJS: `npm install` && `yarn install`
1. Lancez le server symfony : `symfony serve`
1. Lancez le server webpack : `npm run dev-server`
