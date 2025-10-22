<div id="top">

<!-- HEADER STYLE: CLASSIC -->
<div align="center">


# SMARTCAR-INTEGRATED-CAR-RENTAL-MANAGEMENT-SYSTEM

<em>A simple expense tracker application built with Laravel.</em>

<!-- BADGES -->
<img src="https://img.shields.io/github/last-commit/muhanifakh/SmartCar-Integrated-Car-Rental-Management-System?style=flat&logo=git&logoColor=white&color=0080ff" alt="last-commit">
<img src="https://img.shields.io/github/languages/top/muhanifakh/SmartCar-Integrated-Car-Rental-Management-System?style=flat&color=0080ff" alt="repo-top-language">
<img src="https://img.shields.io/github/languages/count/muhanifakh/SmartCar-Integrated-Car-Rental-Management-System?style=flat&color=0080ff" alt="repo-language-count">

<em>Built with the tools and technologies:</em>

<img src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=PHP&logoColor=white" alt="PHP">


|    NRP     |      Name      |
| :--------: | :------------: |
| 5025231075 | Reino Yuris Kusumanegara |

</div>



## Features

- User authentication
- Add, edit, and delete expenses
- View total expenses
- View expenses by category
- View recent transactions
- Category breakdown with a donut chart

## Installation

1. Clone the repository: `git clone https://github.com/your-username/expense-tracker.git`
2. Install dependencies: `composer install` and `npm install`
3. Create a copy of the `.env.example` file and rename it to `.env`
4. Generate an application key: `php artisan key:generate`
5. Run database migrations: `php artisan migrate`
6. Start the development server: `php artisan serve` and `npm run dev`

## Usage

1. Register for a new account or log in with an existing one.
2. Add new expenses using the "Add New Expense" button.
3. View your expenses and category breakdown on the dashboard.
4. Edit or delete expenses from the recent transactions list.

## Database Schema

The database schema consists of three tables:

- `users`: Stores user information.
- `expenses`: Stores expense information, including a foreign key to the `users` and `categories` tables.
- `categories`: Stores expense categories.

## File Structure

- `app/Http/Controllers/ExpenseController.php`: Handles all CRUD operations for expenses.
- `app/Models/Expense.php`: The Eloquent model for the `expenses` table.
- `app/Models/Category.php`: The Eloquent model for the `categories` table.
- `resources/views/dashboard.blade.php`: The main view for the application.
- `routes/web.php`: Defines the application's routes.

## Pages


### Home 

The is the welcome page for the users 
<img width="2839" height="1548" alt="image" src="https://github.com/user-attachments/assets/3a14252f-e95f-4576-b979-e633255d76b6" />

### Dashboard

The dashboard is the main page of the application. It displays the following information:

- A welcome message with the user's name.
- A button to add a new expense.
- A summary of the user's total expenses.
- The user's top expense category.
- A list of the user's recent transactions.
- A breakdown of the user's expenses by category.
<img width="2814" height="1541" alt="image" src="https://github.com/user-attachments/assets/db25188d-d5c4-47dd-b35b-444c7d9b651a" />

### Profile

The profile page allows users to update their profile information and delete their account.
<img width="2791" height="1541" alt="image" src="https://github.com/user-attachments/assets/4ca454c5-dfc8-4ae3-91a5-1bb082dee1c4" />

### Login/Register

The login and register pages allow users to log in to their account or create a new one.
<img width="2849" height="1536" alt="image" src="https://github.com/user-attachments/assets/a921fc21-e993-4589-8b0c-d55668244133" />
<img width="2840" height="1524" alt="image" src="https://github.com/user-attachments/assets/db561f64-6248-4d1f-b884-b162323bb391" />

