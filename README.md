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

8. Go to terminal and run this command (Copy the environment file):
cp .env.example .env

9. Then, this command (Install Laravel dependencies via Composer):
composer install
(It will take a little bit time to install, just chill)

9. Then, this command (Generate application key):
php artisan key:generate

10. Then, this command (Run all database migrations):
php artisan migrate

11. Then, this command (Run database seeders to populate with sample data):
php artisan db:seed

12. Then, this command (Create symbolic link for file storage (for product images)):
php artisan storage:link

13. Then, this command (Install Node.js dependencies):
npm install

14. Then, this command (Compile and build frontend assets):
npm run build

15. Lastly, this command (Start Laravel development server):
php artisan serve

Hope you guys getting all the steps and if there any questions can feel free to ask 👌🏻
