Installation using docker
Make sure you have docker installed. To see how you can install docker on Windows click here.
Make sure docker and docker-compose commands are available in command line.

Clone the project using git
Copy .env.example into .env (Don't need to change anything for local development)
Navigate to the project root directory and run docker-compose up -d
Install dependencies - docker-compose exec app composer install
Run migrations - docker-compose exec app php migrations.php
Open in browser http://127.0.0.1:8080


Download the archive or clone the project using git
Create database schema
Create .env file from .env.example file and adjust database parameters (including schema name)
Run composer install
Run migrations by executing php migrations.php from the project root directory
Go to the public folder
Start php server by running command php -S 127.0.0.1:8080
Open in browser http://127.0.0.1:8080