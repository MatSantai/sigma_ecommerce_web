## Get Started

Here is the step-by-step to ensure the download until the website is going smoothly:

(Open the xampp and start the apache and MySQL)⚠

1. Download the folder

2. Unzip the file

3. Paste the sigma_ecommerce_web folder into C:\xampp\htdocs\dashboard

4. Go to google and search http://localhost/phpmyadmin

5. Create a new database called sigma_ecommerce_web

6. Go to VSCode and open folder of the sigma_ecommerce_web

7. Go to the .env and ensure that the APP_NAME='Sigma Shop' and DB_DATABASE=sigma_ecommerce_web

8. Go to terminal and run this command:
composer install
(It will take a little bit time to install, just chill)

9. Then, this command:
php artisan key:generate

10. Then, this command:
php artisan migrate

11. Then, this command:
php artisan config:clear
php artisan cache:clear
php artisan config:cache

12. Then,
php artisan storage:link

13. Lastly, this command:
php artisan migrate:refresh --seed

And then, you can just command php artisan serve to run it on the localhost 😁😁

Hope you guys getting all the steps and if there any questions can feel free to ask 👌🏻