
Project architecture based on: 
--
https://odan.github.io/slim4-skeleton/architecture.html

Dependencies: 
-
- PHP 7.4
- PostgreSQL server installed

To run the application:
-
- Run ```bin/database-snapshot.sql``` using Postgres query tool in order to create the task-db table
- Copy/rename ```config/env.local.php.dist``` to ```config/env.local.php``` and database user data in this config file
- Run ```composer install```
- Run ```composer run start-dev``` to start app using PHP built-in server on ```localhost:8080``` (or use any other
 web server to host the app)