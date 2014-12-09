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
7. default user is "test@menteer.ca" and password is "password".


technology stack / open source
==============================

* codeigniter 3.0

* ion_auth 2.6



