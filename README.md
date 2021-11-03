# Heroes of the Storm Helper

## Description

Heroes of the Storm Helper is an app for creating builds and tier lists for Blizzard's MOBA game.

## Live demo

A live demo can be viewed here:
<https://heroes-of-the-storm-helper.herokuapp.com/>

## How to setup project locally

### Requirements

- PHP 7.3+ and Composer
- Database supported by Laravel (MySQL, PostgreSQL, SQLite, SQL Server)
- Node.js 16 and NPM
- Git

### Installation

1. Clone the repo locally:
`git clone https://github.com/Skonry/heroes-of-the-storm-helper.git`

2. Navigate to project directory:
`cd heroes-of-the-storm-helper`

3. Install PHP dependencies:
`composer install`

4. Install NPM dependencies:
`npm i`

5. Build assets:
`npm run dev`

6. Setup configuration file .env
`cp .env.example .env`

7. Generate application key:
`php artisan key:generate`

8. Create database

9. Run database migrations:
`php artisan migrate`

10. Run database seeder:
`php artisan db:seed`

11. Run the dev server:
`php artisan serve`


