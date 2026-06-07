# Task Management Application

## Overview

The Task Management Application is a Laravel-based web application that allows users to create, assign, manage, and monitor tasks efficiently. The system supports role-based access control and provides tools for tracking task progress, priorities, deadlines, and categories.

---

## Features

### Authentication
- User Registration
- User Login
- User Logout

### Task Management
- Create Tasks
- Edit Tasks
- Delete Tasks
- View Tasks

### Categories
- Create Categories
- Edit Categories
- Delete Categories

### Task Assignment
- Assign Tasks to Users
- View Assigned Tasks

### Task Tracking
- Pending Status
- In Progress Status
- Completed Status

### Priority Levels
- Low
- Medium
- High

### Authorization
- Admin Role
- Team Member Role
- Guest Role

### Notifications
- Deadline Reminder System

---

## Technologies Used

| Technology | Purpose |
|------------|----------|
| Laravel | Backend Framework |
| PHP | Programming Language |
| Blade | Templating Engine |
| Bootstrap/Tailwind CSS | User Interface |
| MySQL/SQLite | Database |
| Laravel Breeze | Authentication |
| Composer | Dependency Management |

---

## Installation

### Clone Repository

```bash
git clone https://github.com/your-repository-name.git
```

### Navigate to Project

```bash
cd task-management-app
```

### Install Dependencies

```bash
composer install
```

### Copy Environment File

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Configure Database

Update the .env file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=
```

### Run Migrations

```bash
php artisan migrate
```

### Seed Database

```bash
php artisan db:seed
```

### Start Server

```bash
php artisan serve
```

---

## User Guide

### Administrator

Administrators can:

- Manage users
- Create tasks
- Edit tasks
- Delete tasks
- Assign tasks
- Manage categories
- View all tasks

### Team Members

Team members can:

- View assigned tasks
- Update task status
- Track deadlines

### Guests

Guests have limited access to the application.

---

## Task Workflow

1. User logs in.
2. Administrator creates a task.
3. Task is assigned to a user.
4. User updates task status.
5. Administrator monitors progress.
6. System tracks deadlines and reminders.

---

## Security Features

- Authentication
- Authorization Policies
- Middleware Protection
- CSRF Protection
- Form Validation

---

## Database Structure

Main Tables:

- Users
- Tasks
- Categories

Relationships:

- User has many Tasks
- Category has many Tasks
- Task belongs to User
- Task belongs to Category

---

## Project Structure

app/
├── Http/
├── Models/
├── Policies/
├── Providers/

database/
├── migrations/
├── seeders/

resources/
├── views/

routes/
├── web.php

---

## Authors

Group Members:

- Karabo Mpalakane
- Lihle Tuta
- Andile Nhleko
