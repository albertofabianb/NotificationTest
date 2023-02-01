# NotificationTest
Challenge for Gila Software
by Alberto Bohbouth

This challenge was developed in Laravel 8, in Linux with a MySql DB.

See attached two images
========================
1. "Frontend Preview.png"
2. "DER - Notification Test.png" 

Requirements
============
LAMP environment installed and running, or at least a MySql server.


Directions to run the aplication
================================
1. Download the repository.
2. Open a terminal and run composer install (assuming that you have composer installed).
3. Edit the .env file for using a MySql DB and create a database called "notifications".

    For instance:

    DB_CONNECTION=mysql    
    
    DB_HOST=127.0.0.1    
    
    DB_PORT=3306    
    
    DB_DATABASE=notifications
    
    DB_USERNAME=root
    
    DB_PASSWORD=root

4. Run: "php artisan migrate --seed"
5. Launch two servers, i.e. for instance run "php artisan serve" in two terminals.
6. Edit the .env file for the two servers addresses and ports, for instance:

    URL_BACKEND=http://localhost:8001/    
    URL_FRONTEND=http://localhost:8000/

7. Open a browser and go to http://localhost:8000/ or to the URL_FRONTEND configured.
8. Try the application.
______________________________________
