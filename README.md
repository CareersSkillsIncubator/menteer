menteer
=======

installation instructions
=========================

1. download latest copy of Menteer
2. move to server root (if on localhost specify menteer.dev so the index.php defines this as a development install) see index.php for more info
3. (linux) chmod 777 /application/cache and /application/logs
4. modify /application/config/database_clean.php and email_clean.php by removing "_clean" from filename
5. configure database.php to point to your database after importing the menteer.sql file into your database
6. modify /application/config/ion_auth.php file as needed for the authentication library
7. configure index.php to use your local environment if thats the case
8. default user is "test@menteer.ca" and password is "password".

features
=========

* mobile friendly and responsive

* database driven (extendable)

* drop and go code-base (minimal setup required)

* PHP 5.4+ and MySQL 5.1 required


technology stack / open source
==============================

* codeIgniter 3.0 - PHP Framework

* ion_auth 2.6 - Authentication Library

* normalize.css v3.0.2 | MIT License | git.io/normalize

* https://github.com/h5bp/html5-boilerplate/blob/master/src/css/main.css

* https://github.com/sliptree/bootstrap-tokenfield

* Bootstrap v3.3.1 (http://getbootstrap.com)

* jQuery 1.11.1 (jQuery UI, jQuery Carousel Plugin, SmoothScroll Module, JavaScript Custom Forms / Checkbox Module)

* Hammerjs v2.0.4


optional services used
======================

* sendgrid (email STMP) - for sending email

* uservoice - for feedback and user tracking

* google analytics


road map
========

* Extending admin to manage database driven questions/questionnaire

* Extending admin control panel

* ?





