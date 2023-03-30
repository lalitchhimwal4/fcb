# Getting Started:

To begin working on this project locally you will need to perform the following steps:

1. Install and setup php artisan and composer on your machine
2. Install and setup XAMPP or MAMP on your machine
3. Create a local mysql database
4. Connect to your local database
5. Run required artisan commands
6. Common troubleshooting to be aware of

## 1. Install and setup php artisan and composer on your machine

You can install and setup composer and php artisan following the steps here `https://getcomposer.org/download/`

## 2. Install and setup XAMP or MAMP on your machine

You can install XAMPP following this guide `https://www.apachefriends.org/index.html`

OR

You can install MAMP following this guide `https://www.mamp.info/en/windows/`

## 3. Create a local mysql database

-   Open your XAMPP or MAMP control panel and run the server and MySQL database
-   Open phpMyAdmin and create a new local database
-   Run the `git clone` command in the desired directory on your machine to clone the project locally

## 4. Connect to your local database

-   Open the project in your desire code editor
-   Make a copy of the .env.example file and rename it .env
-   Set your database connection settings accordingly to your local database you created
-   Save the .env file

## 5. Run required artisan commands

You will need to run the below commands in the below order to begin work on the project:

1. `composer update`
2. `php artisan migrate`
3. `php artisan migrate --path=/database/migrations/Provider`
4. `php artisan storage:link`
5. `php artisan key:generate`
6. `php artisan db:seed`
7. `php artisan serve`

## 6. Common troubleshooting to be aware of

An issue that may happen when setting up the project on your local maybe be that the command `composer update` throws a `php` version error, noting that the version of `php` set in your `composer.json` does not match the version of `php` installed on your machine.

To fix this:

1. Go to your `composer.json`
2. Find the `require` setting
3. Under `require` manually update the version of `php` set from `^7.3` to `your local version`
4. Save the `composer.json` file

## 7. Google Maps API

For the Provider Search funcitonality to work as expected enable the following APIs in Google Maps Platform:
1. Maps JavaScript API
2. Places API
3. Distance Matrix API

Generate the API key and enter it in the **Admin > General Settings** page.

There is an additional field for search radius under **Admin > General Settings** page. If a value is entered, then the search will filter results within this area.

## 8. Payments using PayPal

All the PayPal details are entered in **Admin > Payment Settings** page.

There are 2 types of payments collected from Members in the system:
1. **Subscription payments**: For this, enter the PayPal Subsciption's Product ID and Plan ID under Admin > Payment Settings page. When the members enroll, they will be asked to login to PayPal and subscribe to the plan. PayPal will take care of charging the members with the amount anually or for the time period of the plan. We will confirm that the anual payments for the plan are made. If the payments fail, then that member is notified via email and set to inactive along with all their dependents.
2. **Claim payments**: 

## 9. Importing from Old Database

There is **Import Old Data** section in Admin which will help importing Provider Offices and Providers into the database.

If the APP_ENV in the .env file is set to **staging** then the emails for Provider Enrollment are not send. Otherwise, the emails are send to the emails associated to the Provider Offices.