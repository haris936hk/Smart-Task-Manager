# Smart Task Manager

A web-based task management system built with PHP, MySQL, HTML, CSS, and JavaScript. The application provides role-based access control for Managers and Employees to efficiently manage tasks and team members.

## Features

### 🔐 Authentication & User Management
- Secure user registration and login system
- Password hashing for enhanced security
- Role-based access control (Manager/Employee)
- User account management (Create, Update, Delete)
- Password reset functionality

### 👨‍💼 Manager Features
- **Dashboard**: Overview of all task statistics
- **Task Management**: Create and assign tasks to employees
- **Task List**: View all tasks with assignee details
- **User Management**: Create, update, and delete employee accounts
- **Team Oversight**: Monitor task progress across the organization

### 👩‍💻 Employee Features
- **Personal Dashboard**: View personal task statistics
- **Task List**: View assigned tasks with status updates
- **Task Status Updates**: Mark tasks as completed or in progress
- **Deadline Tracking**: Monitor task deadlines

## Tech Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 8.0+
- **Frontend**: HTML5, CSS3, JavaScript
- **Authentication**: Session-based authentication
- **Security**: Password hashing, prepared statements, input validation

## Database Schema

### Users Table
- `user_id` (Primary Key)
- `username` (Unique)
- `full_name`
- `email` (Unique)
- `password_hash`
- `role` (Manager/Employee)
- `is_active` (Boolean)

### Tasks Table
- `task_id` (Primary Key)
- `title`
- `description`
- `priority` (High/Medium/Low)
- `status` (In Progress/Completed)
- `due_date`
- `created_at`

### TaskTeamMembers Table
- `task_id` (Foreign Key)
- `employee_id` (Foreign Key)

### TaskDetailsWithTeam View
- Consolidated view showing task details with assigned team members

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 8.0 or higher
- Apache/Nginx web server
- Web browser

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/haris936hk/smart-task-manager.git
   cd smart-task-manager
   ```

2. **Database Setup**
   - Create a MySQL database named `task_manager`
   - Import the database schema (create the tables mentioned above)
   - Create the `TaskDetailsWithTeam` view for consolidated task information

3. **Configure Database Connection**
   - Update `db_connection.php` with your database credentials:
   ```php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "task_manager";
   ```

4. **Web Server Configuration**
   - Place the project files in your web server's document root
   - Ensure PHP is properly configured
   - Make sure session support is enabled

5. **Initial Setup**
   - Access the application through your web browser
   - Create an admin account using `SignUp.php`
   - Start managing tasks and users

## Usage

### For Managers
1. **Login** with manager credentials
2. **Create Tasks** and assign them to employees
3. **Monitor Progress** through the dashboard
4. **Manage Users** by creating, updating, or deleting accounts

### For Employees
1. **Login** with employee credentials
2. **View Assigned Tasks** in the task list
3. **Update Task Status** by marking tasks as completed
4. **Track Deadlines** and manage workload

## Security Features

- **Password Hashing**: All passwords are hashed using PHP's `password_hash()` function
- **Prepared Statements**: SQL injection prevention through prepared statements
- **Input Validation**: Server-side validation and sanitization
- **Session Management**: Secure session handling for user authentication
- **Role-based Access**: Different access levels for managers and employees

## API Endpoints

The application includes AJAX endpoints for:
- User fetching by role
- Account updates
- Account deletion
- Task status updates

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
