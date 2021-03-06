menteer
=======

installation instructions
=========================

1. download latest copy of Menteer
2. move to server root (if on localhost specify menteer.dev so the index.php defines this as a development install) see index.php for more info
3. (linux) chmod 777 /application/cache and /application/logs
4. rename /application/config/config_clean.php to config.php and set the encryption to something unique
5. modify /application/config/database_clean.php and email_clean.php by removing "_clean" from filename
6. configure database.php to point to your database after importing the /sql/menteer.sql file into your database
7. modify /application/config/ion_auth.php file as needed for the authentication library
8. configure index.php to use your local environment if thats the case
9. chmod 777 /uploads folder and set "php_value upload_max_filesize 20M" & "php_value post_max_size 21M" in your htaccess
10. default user - > create account and change in user table -> field active to 1 for new user / to make admin see users_groups and insert user with admin group

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


security
=========

* XSS (Cross-Site Scripting) Filtering - This filter looks for commonly used techniques to embed malicious JavaScript into your data, or other types of code that attempt to hijack cookies or do other malicious things.

* SQL Injection Protection

* CSRF (Cross-Site Request Forgery) Protection - which is the process of an attacker tricking their victim into unknowingly submitting a request.  Automatically triggered for every non-GET HTTP request.

* Input Validation (All GET AND POST data Cleaned and Validated)

* MySQLi Driver used

* Encrypted URL used when doing sensitive tasks

* Forced SSL/HTTPS

* SMTP (Sendgrid) email ready (out-of-the-box)

* Cloudflare tested and ready


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





