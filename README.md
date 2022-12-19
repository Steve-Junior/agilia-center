# Agilia Center Cinema

This repo is functionality complete — PRs and issues welcome!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone git@github.com:Steve-Junior/agilia-center.git

Switch to the repo folder

    cd agilia-center

Install all the dependencies using composer

    composer install

Install all the dependencies using npm

    npm install

Build the asset required

    npm run dev

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations alongside seeding (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:Steve-Junior/agilia-center.git
    cd agilia-center
    composer install
    npm install
    npm run dev
    cp .env.example .env
    php artisan key:generate

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate --seed
    php artisan serve

## Database seeding

**Populate the database with seed data with categories. This can help you to quickly start testing a couple of frontend and start using it with ready content.**

Open the CategoriesSeeder and set the property values as per your requirement

    database/seeds/CategoriesSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
