# Installation guide
This is a step by step guide were we will explain how to get this website up and running on your machine.
### Requirements Before Setup
This project uses a few frameworks and extension, so before setting up the project, make sure you have the following installed:
- PHP
- PHP composer
- Laravel
- MySQL
After making sure that you have them installed you can proceed with the guide.

## Step 1: Cloning and Opening the Project

You are starting by cloning the project from GitHub with following command:
`git clone <link-to-project>`
Alternatively, you can download the ZIP file and unpack it.


After you cloned project to your laptop, inside the project folder you will find following folder structure:
```
Project-Folder
|--- .vscode
|--- git
|--- music-player
```

The entire project is stored inside the `music-player` folder. Open this folder to proceed with next step.

## Step 2: Composer Installation 
Inside the `music-player` folder run the `composer install` command. This will prepare the necessary files for deploying the website. Wait until the installation finishes before proceeding with the next step.

## Step 3: Environment Setup
To setp up an environment, first create a `.env` file. You can do it by running following command
```
copy .env.example .env
```

This copies the `.env.example` file to a new `.env` file.
After that you need to generate the key for your project with:
```
php artisan key:generate
```

## Step 4: Connecting the Database

This project uses MySQL, so to make it fully operational, you need to create a MySQL database on your machine (alternatively you can skip this step and create the database during the Step 5: Migration). 

Then you need to open the `.env` and set the following parameters:

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
Since this project uses a database we need to perform the migration with the following command:
```
php artisan migrate 
```
If you did not create the database in Step 4, you will get following message:
```
WARN  The database '<database-name>' does not exist on the 'mysql' connection.

Would you like to create it? (yes/no) [yes]
```

Type `y` and press Enter in order to complete the migration.

## Step 6: Host project

Finally, if you did everything right, you should be able to run the following command to start the server:
```
php artisan serve
```
After a short time, the project will be up and running. Now, in your browser, you can type this address `http://localhost:8000` and try the project out!