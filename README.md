## Job Hunt Tracker

This is my personal job application tracker I built with Laravel + Vite. I wanted something lightweight but still powerful enough to keep track of companies, positions, and application statuses without juggling a bunch of random spreadsheets.

## The app lets me:

Store and manage companies (name, website, location, etc.)

Log applications with details like role, status, salary range, date applied, and notes

Keep everything tied to my user account so it’s private and organized

Use Laravel Breeze auth for login/registration

## Tech Stack

Backend: Laravel 12 (PHP 8)

Frontend: Vite (Hot Module Reload for a smooth dev experience)

Database: SQLite (easy local setup, can swap to MySQL/Postgres)

Auth: Laravel Breeze

## Features

Add/edit/delete companies

Add/edit/delete job applications linked to companies

Authenticated access — only see your own data

Salary range + notes support

Laravel + Vite integration for modern frontend workflow promptly addressed.

! [Dashboard](Screenshot1.png)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Setup Instructions

Clone the repo

git clone <repo-url>
cd job-hunt-tracker


Install PHP & JS dependencies

composer install
npm install


Set up your .env file

cp .env.example .env
php artisan key:generate


Run migrations

php artisan migrate


Serve the app
In two separate terminals:

php artisan serve
npm run dev


Log in & start tracking

Register a user account

Add companies (currently via Tinker — UI coming soon)

Add applications tied to those companies

## Future Plans

Add a UI for adding companies (no more Tinker)

Better filtering/sorting on applications

Optional resume/cover letter uploads

Thank you for visiting!