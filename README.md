# TaskFlow Task Management Application

TaskFlow is a Laravel 9 web application for managing team tasks, categories, deadlines, priorities, and user roles. It includes authentication, role-based access control, task assignment rules, deadline reminders, seeded demo data, and feature tests.

## Main Features

- User registration, login, and logout
- Admin, team member, and guest roles
- Role-protected dashboards and management routes
- RESTful task, category, and user routes
- Task creation, editing, deletion, filtering, and assignment
- Team members can only assign tasks to themselves
- Admin users can assign tasks to any admin or team member
- Task categories with colors
- Priority and status tracking
- Deadline validation and reminder support
- Notification preference settings
- Custom 403, 404, and 500 error pages

## Technology Stack

| Tool | Purpose |
| --- | --- |
| Laravel 9 | Backend framework |
| PHP 8 | Server-side language |
| Blade | Views and reusable layouts |
| Bootstrap | Interface styling |
| SQLite | Local development database |
| Eloquent ORM | Models, relationships, scopes, and queries |
| Laravel Policies | Authorization |
| Form Requests | Centralized validation |
| PHPUnit | Automated tests |
| Vite | Frontend asset build |

## Local Setup

Open PowerShell in the project folder:

<<<<<<< HEAD
```powershell
cd C:\Users\lenovo\Downloads\Task-Management-App-main
=======
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
| Bootstrap | User Interface |
| SQLite | Database |
| Laravel Breeze | Authentication |
| Composer | Dependency Management |

---

## Installation

### Clone Repository

```bash
git clone https://github.com/your-repository-name.git
>>>>>>> 97d6590cf4ae590d05e62115d1ca70712c621272
```

Install dependencies:

```powershell
composer install
npm install
```

Create the environment file if it does not exist:

```powershell
copy .env.example .env
```

For local SQLite development, use these database settings in `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Create the SQLite database file:

```powershell
New-Item -ItemType File -Path database\database.sqlite -Force
```

Generate the Laravel app key:

```powershell
php artisan key:generate
```

Create and seed the database:

```powershell
php artisan migrate:fresh --seed
```

Build frontend assets:

```powershell
npm run build

Open the app:

```text
http://127.0.0.1:8082
```

## Seeded Login Accounts

| Role | Email | Password |
| --- | --- | --- |
| Admin | admin@flow.ac.za | P@ssword |
| Team member | developer@flow.ac.za | P@ssword |
| Guest | guest@flow.ac.za | P@ssword |

## User Roles

### Admin

- View and manage users
- Create, edit, delete, and assign tasks
- Assign tasks to admins or team members
- Manage categories
- Send deadline reminders

### Team Member

- Create tasks assigned to themselves
- View tasks assigned to them or created by them
- Update tasks they are responsible for
- Manage task categories

### Guest

- Can log in and view permitted dashboard areas
- Cannot create tasks, manage categories, or manage users

## Database Structure

Main tables:

- `users`
- `categories`
- `tasks`
- `password_resets`
- `failed_jobs`
- `personal_access_tokens`

Key relationships:

- A category has many tasks
- A task belongs to a category
- A task belongs to an assignee user
- A task belongs to a creator user
- A user has many assigned tasks
- A user has many created tasks

## Validation And Authorization

- Task and category validation use Form Request classes.
- Deadline validation uses a custom `DeadlineAfterTodayKAL` rule.
- Policies protect task, category, and user actions.
- Middleware protects authenticated routes and role-specific routes.
- Login and registration routes are rate limited.
- Reminder routes are rate limited and admin-only.

## Testing

Run the test suite:

```powershell
php artisan test
```

The tests cover:

- Application homepage response
- Team member assignment forced to self
- Admin assignment to another team member
- Guest category access restriction
- Team member user-management restriction
- Past deadline validation

## Security Notes

- CSRF protection is enabled on forms.
- Blade escaping is used for dynamic text output.
- Eloquent ORM is used for database queries.
- Policies and middleware enforce role permissions.
- Route throttling protects authentication and reminder actions.
- `.env` should not be committed to public repositories.

## Authors

Group Members:
- Lihle Tuta
- Andile Nhleko
- Karabo Ntotole Mpalakane
