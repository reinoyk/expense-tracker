# Expense Tracker

A simple expense tracker application built with Laravel.

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

### Dashboard

The dashboard is the main page of the application. It displays the following information:

- A welcome message with the user's name.
- A button to add a new expense.
- A summary of the user's total expenses.
- The user's top expense category.
- A list of the user's recent transactions.
- A breakdown of the user's expenses by category.

### Profile

The profile page allows users to update their profile information and delete their account.

### Login/Register

The login and register pages allow users to log in to their account or create a new one.
