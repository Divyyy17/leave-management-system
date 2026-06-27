# Leave Management System

A simple Leave Management System built using **Laravel 12**, **Laravel Breeze**, **Tailwind CSS**, and **MySQL**.

## Features

### Employee

* Register as an Employee
* Login
* Apply for leave
* View their own leave requests

### Manager

* Register as a Manager
* Login
* View all leave requests
* Approve leave requests
* Reject leave requests

## Business Rules

* Leave start date cannot be in the past.
* Employees cannot apply for overlapping leave dates.
* Only Managers can approve or reject leave requests.
* Once a leave request is approved or rejected, it cannot be modified.

## Tech Stack

* Laravel 12
* PHP
* MySQL
* Laravel Breeze
* Tailwind CSS

## Installation

1. Clone the repository

```bash
git clone https://github.com/Divyyy17/leave-management-system.git
```

2. Navigate to the project

```bash
cd leave-management-system
```

3. Install dependencies

```bash
composer install
```

4. Copy the environment file

```bash
cp .env.example .env
```

5. Generate the application key

```bash
php artisan key:generate
```

6. Configure your database in the `.env` file.

7. Run migrations and seed the database

```bash
php artisan migrate --seed
```

8. Start the development server

```bash
php artisan serve
```

## Test Credentials

### Manager

**Email:** `manager@test`

**Password:** `password123`

### Employee 1

**Email:** `divya@test`

**Password:** `password123`

### Employee 2

**Email:** `testemployee1@gmail.com`

**Password:** `password123`

## Project Structure

* Employee Dashboard
* Manager Dashboard
* Leave Application
* Leave Approval & Rejection
* Authentication & Authorization
* Role-based Access Control

## Author

**Divya**
