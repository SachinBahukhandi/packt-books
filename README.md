Steps to setup:

1. `git clone` to clone the repo
2. cd <Project_DIR>
3. Please run `cp .env.example .env` or manually make a copy of it.
4. Kindly run `composer install`.
5. Kindly run `npm install`.
6. Please name the database and setup as needed. It uses MySQL thus please set it up accordingly.
7. run `php artisan migrate` to publish data migrations.
8. Please make sure to run `php artisan queue:work` as it uses queue to import data from the API using the endpoint: https://fakerapi.it/api/v1/books?_quantity=100
9. Please seed the users, by running the command: `php artisan db:seed`
10. Once done, kindly run `npm run dev`.
11. You could open the page: http://127.0.0.1:8000/books
12. There are two users seeded with the following details:
    a. Email: user@example.com, Password: user@123
    b. Email: admin@example.com, Password: admin@123
