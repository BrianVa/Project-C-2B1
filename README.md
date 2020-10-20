# Project C 2B1
 Project C 2B1 Hogeschool Rotterdam 2020

install instructions.

step 1: download & install xampp.<br/>
step 2: download & install composer.<br/>
step 3: create a folder named www in C:\xampp\htdocs<br/>
step 4: clone the project to the www folder.<br/>
step 5: open cmd.<br/>
step 6: cd with this command into the project folder: cd C:\xampp\htdocs\www\Project-C-2B1-master<br/>
step 7: excute command: copy .env.example .env<br/>
step 8: excute command: composer install <br/>
step 9: excute command: php artisan key:generate<br/>
step 10: (optional) setup .env for database.<br/>
step 11: open xampp and click start on Apache & MySQL.<br/>
step 12: go to http://localhost/www/Project-C-2B1-master/public/ & check if it is working.<br/>



setup dev url.

step 1: if xampp is running stop Apache & MySQL.<br/>
step 2: open C:\xampp\apache\conf\extra\httpd-vhosts.conf<br/>
step 3: add this to the end of the file:<br/>
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/www/Project-C-2B1-master/public"
    ServerName cimsolutions.test
</VirtualHost>

```
step 4: open notepad as administrator and click on file -> open and go to the following folder C:\Windows\System32\drivers\etc<br/>
step 5: change text documents on the bottom right to all files and open hosts.<br/>
step 6: add this to the end of the file: <br/>
```
127.0.0.1 localhost
127.0.0.1 cimsolutions.test

```
step 7: open xampp start Apache & MySQL and go to cimsolutions.test & cimsolutions.test/admin to check if it is working.<br/>
