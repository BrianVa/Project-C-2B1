# Project C 2B1
 Project C 2B1 Hogeschool Rotterdam 2020

install instructions.

step 1: download & install xampp
step 2: download & install composer
step 3: create a folder named www in C:\xampp\htdocs
step 4: clone the project to the www folder
step 5: open cmd
step 5: cd with this command into the project folder: cd C:\xampp\htdocs\www\Project-C-2B1-master
step 6: excute command: copy .env.example .env
step 7: excute command: php artisan key:generate
step 8: (optional) setup .env for database
step 9: open xampp and click start on Apache & MySQL
step 10: go to http://localhost/www/Project-C-2B1-master/Laravel/public/ & check if it is working



setup dev url.

step 1: if xampp is running stop Apache & MySQL
step 2: open C:\xampp\apache\conf\extra\httpd-vhosts.conf
step 3: add this to the end of the file:
```
<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\www\Project-C-2B1-master"
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\www\Project-C-2B1-master\public"
    ServerName cimsolutions.local
</VirtualHost>

```
step 4: open notepad as administrator and click on file -> open and go to the following folder C:\Windows\System32\drivers\etc
step 5: change text documents on the bottom right to all files and open hosts
step 6: add this to the end of the file: 
```
127.0.0.1 localhost
127.0.0.1 cimsolutions.dev

```
step 7: open xampp start Apache & MySQL and go to cimsolutions.local & cimsolutions.local/admin to check if it is working

