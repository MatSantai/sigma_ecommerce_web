# Get Started

Here is the step-by-step guide to set up the Sigma Shop e-commerce website:

## Prerequisites ⚠️
- XAMPP installed and running (Apache & MySQL)
- Composer installed
- Node.js and npm installed
- VS Code (recommended) or any code editor

## Setup Steps

**1. Download and Extract**
- Download the project folder
- Unzip the file
- Paste the sigma_ecommerce_web folder into C:\xampp\htdocs\dashboard

**2. Database Setup**
- Open your browser and go to http://localhost/phpmyadmin
- Create a new database called sigma_ecommerce_web

**3. Project Configuration**
- Open VS Code and open the sigma_ecommerce_web folder
- Go to the .env file and ensure:
APP_NAME='Sigma Shop'
DB_DATABASE=sigma_ecommerce_web

**4. Environment Setup**

_Copy the environment file_

- cp .env.example .env

**5. Install Dependencies**

_Install Laravel dependencies via Composer_

- composer install

_(This may take a few minutes to complete)_

**6. Generate Application Key**

- php artisan key:generate

**7. Database Setup**

_Run all database migrations_

- php artisan migrate
   
_Run database seeders to populate with sample data_

- php artisan db:seed

**8. File Storage Setup**

_Create symbolic link for file storage (for product images)_

- php artisan storage:link

**9. Frontend Setup**

_Install Node.js dependencies_

- npm install
   
_Compile and build frontend assets_

- npm run build

**10. Start the Application**

_Start Laravel development server_

- php artisan serve

## Access the Website
Open your browser and go to: http://localhost:8000

## Default Login Credentials

**Admin Account:**
- Email: admin@sigma.com
- Password: admin123

**Customer Account:**
- Email: customer@sigma.com
- Password: password

## Features Available
- User registration and login
- Product browsing and search
- Shopping cart functionality
- Order placement and tracking
- Admin dashboard for product management
- User profile management

Need help? Feel free to ask questions! 👌🏻
