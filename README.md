# Symfony Application

This is a backend Symfony application that can handle various content rating by using REST API methods.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for testing purposes. 


### Prerequisites

You need to have your own server or you can install XAMPP for localhost.
Your system needs to fulfill the list of following requirements:
- PHP with a minimum version of 5.5.9
- Composer
- JSON enabled
- ctype enabled



## Installing

A step by step guide to install Symfony on your system.

Open up "shell" and go to public_html of host or to htdocs if you are using xampp.
After that run the following command to install Symfony 3 on your server:

```
composer create-project symfony/framework-standard-edition projectname "3.1"
```

While Symfony is downloading to your server, it will ask for your database informations.
After giving the database informations it must give a successfully message for Symfony installing.

We will check if composer needs any updates by using the command:

```
composer install
```

Your application have been installing, and you can access it in the followin URL:

```
http://yoursiteurl/yourprojectname/web/
```

If you get a message saying: Welcome to Symfony 3.1.0, you have successfully installed Symfony.

### Creating the form for user to input

To create the form and send the informations to database, we need to configure the database informations. You can check them again at: 

```
app/config/parameters.yml
```

Go to your project directory and create the db:

```
php bin/console doctrine:generate:entity
```

Entity shortcut name: AppBundle:Rating
Annotation: yml
Add the table fields: ratingid, uri and rating

After you have finished creating the table fields, to create the table write:

```
php bin/console doctrine:schema:update --force
```

Go to src/AppBundle/Controller/DefaultController.php
This is the file for the form builder.

After form, we need to create the views.
We have addrating.html.twig and the sendrating.html.twig
These files are at: app/Resources/views/default/
addrating.html.twig is the view for the form input
sendrating.html.twig is the form that give successfully information.
Also is the ratinview.html.twig that can be used for getting rating informations from db

The rating form can be accessed at:

```
http://yoursiteurl/yourprojectname/web/app_dev.php/addrating
```

You can fill the form and see the database table have been updated.
Also you can check any rating that you have in database in url:

```
http://yoursiteurl/yourprojectname/web/app_dev.php/ratingview/{id]
```

### Creating the API

Create the file RatingController.php at: src/AppBundle/Controller/Api/v1/RatingController.php and add the code that its in my project.

You can check the API functionality by using Postman, it can be downloaded at: https://www.getpostman.com/

You can use there POST and GET method.


## Running the tests

POST method example:

```
http://yoursiteurl/yourprojectname/web/app_dev.php/api/v1/rating?visitorid=algert&uri=http://www.codecacao.com&rating=1
```

GET method example:

```
http://yoursiteurl/yourprojectname/web/app_dev.php/api/v1/rating/1
```

Also you can use ratinview.html.twig that I have mentioned before:

```
http://yoursiteurl/yourprojectname/web/app_dev.php/ratingview/1
```



## License

This project is licensed under the GNU GENERAL PUBLIC LICENSE - see the LICENSE file for details

