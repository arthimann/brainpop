# BrainPOP Exam

### INIT The Project
To init the project you need to run the following commands:

- Create `.env` file from `.env.example`
- Create DB. Default name: `brainpop`
- `composer install`
- `php artisan jwt:secret`
- `php artisan migrate`

### Routes

You have a full list of routes under: `php artisan route:list`
> **NOTE!** Some routes require bearer token!

This project contains a full list of RESTAPI requests for [Postman](https://www.postman.com). <br>
The file located in **postman** folder.

