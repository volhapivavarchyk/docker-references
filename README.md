# Detecting inconsistencies in blob reference counts

## Introduction
The application detects inconsistencies in blob reference counts.

## Installation
1. Download the repository zip then extract the zip or clone the repository
2. Make a copy of the `.env.dist` file `cp .env.dist .env`. Add needed credentials
3. Put the DB dumps into docker/mysql-init
3. Build and run the application: `init.sh`
4. Run the command `bash docker exec -it ref-php bash`.
5. Change the directory `cd refrences`.
6. Set up the dependencies `composer install`.
8. Add a new host `term-popularity.loc` to the `/etc/hosts` file 

The application can be accessed via `http://references.loc:8081/`

## Running automated tests
1. docker exec -it php bash
2. php bin/phpunit
