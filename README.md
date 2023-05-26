# Footballmarket

## Setup and Installation

To set up and install the application, follow these steps:

1. Go to the `./docker` folder and type `docker-compose up -d`.

After that, go to the PHP container and run the command `composer install` to install the required dependencies.

## Database Migration and Load Fixtures

To migrate the database and load fixtures (fake data), follow these steps:

1. In the PHP container, run the command `bin/console doctrine:migrations:migrate --no-interaction` to migrate the database.

2. To load the fixtures, run `bin/console doctrine:fixtures:load --no-interaction` to load the fake data into the database.

After completing these steps, Footballmarket should be set up and ready to use.

