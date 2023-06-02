# testKoralp


Pour initialiser le projet :

  - Modifier la variable 'DATABASE_URL' dans le fichier .env.dev
  - run 'php bin/console doctrine:database:create'
  - run 'composer install'
  - run 'php bin/console make:migration'
  - run 'php bin/console doctrine:migrations:migrate'


L'affichage des pages collaborateurs nécessitent une authentification.
