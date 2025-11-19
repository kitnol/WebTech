# Instalation guide
This is a step by step guide were we will explain how to get up and running this website on your machine.
### Requirments before set up
This project make use of a few frameworks and extension, so before setting up the project you would need to install the following things:
- PHP
- PHP composer
- Laravel
- MySQL
After making sure that you have them installed you can proceed with the guide.

## Step 1: cloning and opening the project

You are starting with cloning the project from github with following command
`git clone <link-to-project>`
Or just downloading zip which then you need to unpack.


After you cloned project to your laptop, inside the project folder you will find following folder structure:
```
Project-Folder
|--- .vscode
|--- git
|--- music-player
```

Hole project stored inside `music-player` folder, so open this folder and proceed with next step.

## Step 2: Composer instalation 
Inside `music-player` you need to run `composer install` command, this will prepare some files for deploying the website. Wait until instalation finishes and after proceed with next step.

## Step 3: Enviorment setup
To setp up an enviorment at first you need to creat `.env` file. You can do it by running following command
```
copy .env.example .env
```

It will copy `.env.example` file to a `.env`.
After that you need to generate keys for you project with command
```
php artisan key:generate
```

## Step 4: Connecting the database

This project makes use of the MySQL database, so in order to make it fully operational you need to create on your machine MySQL database (also you can skip this and create database during migrations step 5). Then you need to open `.env` file from previous example and set following paarametrs:

```
DB_CONNECTION=mysql
DB_HOST= <database-adress>
DB_PORT= <database-port>
DB_DATABASE= <database-name>
DB_USERNAME= <your-MySQL-username>
DB_PASSWORD= <your-MySQL-password>
```

**Example:**
```
DB_CONNECTION= mysql
DB_HOST= 127.0.0.1
DB_PORT= 3306
DB_DATABASE= player
DB_USERNAME= admin
DB_PASSWORD= admin
```

## Step 5: Migration
Since this project uses database we need to perform migration with following command:
```
php artisan migrate 
```
If you did not create database during step 4, you will get following message:
```
WARN  The database '<database-name>' does not exist on the 'mysql' connection.

Would you like to create it? (yes/no) [yes]
```

Write `y` and press enter in order to complite migration.

## Step 6: Host project

This step is final step, if you did everything right, you should be able to run following command:
```
php artisan serve
```
After some time project gonna be up and running, then in you browser you should be able to type this address `http://localhost:8000` to try it out!
