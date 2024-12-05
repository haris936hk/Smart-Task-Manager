<?php
class User {
    protected int $userID;
    protected string $username;
    protected string $password;
    protected string $email;
    protected PDO $db;

    public function __construct(PDO $db, int $userID = 0) {
        $this->db = $db;
        $this->userID = $userID;

        if ($userID > 0) {
            $this->loadUserDetails();
        }
    }

    private function loadUserDetails(): void {
        $stmt = $this->db->prepare("SELECT * FROM Users WHERE userID = :userID");
        $stmt->execute(['userID' => $this->userID]);
        $user = $stmt->fetch(PDO::FETH_ASSOC);

        if ($user) {
            $this->username = $user['username'];
            $this->password = $user['password'];
            $this->email = $user['email'];
        }
    }

    public function logIn(string $username, string $password): bool {
        $stmt = $this->db->prepare("SELECT * FROM Users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $this->userID = $user['userID'];
            $this->username = $user['username'];
            $this->email = $user['email'];
            return true;
        }
        return false;
    }

    public function logOut(): void {
    }

    public function resetPassword(string $email, string $newPassword): bool {
        if (strlen($newPassword) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters');
        }

        $stmt = $this->db->prepare("SELECT userID FROM Users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() === 0) {
            throw new Exception('Email not found');
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE Users SET password = :password WHERE email = :email");
        return $stmt->execute(['password' => $hashedPassword, 'email' => $email]);
    }
}

class Admin extends User {
    public function __construct(PDO $db, int $userID = 0) {
        parent::__construct($db, $userID);
    }

    public function createAccount(array $userDetails): bool {
        try {
            $this->validateUserDetails($userDetails);

            $hashedPassword = password_hash($userDetails['password'], PASSWORD_DEFAULT);

            $this->db->beginTransaction();

            $stmt = $this->db->prepare(
                "INSERT INTO Users (username, password, email, user_type) 
                 VALUES (:username, :password, :email, :user_type)"
            );
            $stmt->execute([
                'username' => $userDetails['username'],
                'password' => $hashedPassword,
                'email' => $userDetails['email'],
                'user_type' => $userDetails['user_type']
            ]);

            $userID = $this->db->lastInsertId();

            $roleTable = $userDetails['user_type'] . 's'; 
            $stmt = $this->db->prepare(
                "INSERT INTO {$roleTable} ({$userDetails['user_type']}ID) VALUES (:userID)"
            );
            $stmt->execute(['userID' => $userID]);
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Create account error: " . $e->getMessage());
            return false;
        }
    }

    public function updateAccount(int $userID, array $updatedDetails): bool {
        try {
            $this->validateUserDetails($updatedDetails, true);

            $updateFields = [];
            $params = ['userID' => $userID];

            foreach ($updatedDetails as $field => $value) {
                if ($field !== 'password') {
                    $updateFields[] = "$field = :$field";
                    $params[$field] = $value;
                }
            }

            if (isset($updatedDetails['password'])) {
                $updateFields[] = "password = :password";
                $params['password'] = password_hash($updatedDetails['password'], PASSWORD_DEFAULT);
            }

            $query = "UPDATE Users SET " . implode(', ', $updateFields) . " WHERE userID = :userID";
            $stmt = $this->db->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Update account error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteAccount(int $userID): bool {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("SELECT user_type FROM Users WHERE userID = :userID");
            $stmt->execute(['userID' => $userID]);
            $userType = $stmt->fetchColumn();

            if ($userType) {
                $roleTable = $userType . 's'; 
                $stmt = $this->db->prepare("DELETE FROM {$roleTable} WHERE {$userType}ID = :userID");
                $stmt->execute(['userID' => $userID]);
            }

            $stmt = $this->db->prepare("DELETE FROM Users WHERE userID = :userID");
            $stmt->execute(['userID' => $userID]);

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Delete account error: " . $e->getMessage());
            return false;
        }
    }

    public function changePassword(int $userID, string $newPassword): bool {
        if (strlen($newPassword) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters');
        }

        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare(
                "UPDATE Users SET password = :password WHERE userID = :userID"
            );
            return $stmt->execute([
                'password' => $hashedPassword,
                'userID' => $userID
            ]);
        } catch (PDOException $e) {
            error_log("Change password error: " . $e->getMessage());
            return false;
        }
    }

    private function validateUserDetails(array $details, bool $isUpdate = false): bool {
        $required = ['username', 'email'];
        if (!$isUpdate) {
            $required[] = 'password';
            $required[] = 'user_type';
        }

        foreach ($required as $field) {
            if (!$isUpdate && empty($details[$field])) {
                throw new InvalidArgumentException("Missing required field: $field");
            }
        }

        if (isset($details['email']) && !filter_var($details['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email format');
        }

        if (isset($details['username']) && strlen($details['username']) < 3) {
            throw new InvalidArgumentException('Username must be at least 3 characters');
        }

        if (isset($details['password']) && strlen($details['password']) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters');
        }

        if (!$isUpdate && !in_array($details['user_type'], ['Admin', 'Employee', 'Manager'])) {
            throw new InvalidArgumentException('Invalid user type');
        }

        return true;
    }
}

class Manager extends User {
    public function createTask(array $taskDetails): bool {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO Tasks (title, description, priority, deadline, category, status, created_by)
                 VALUES (:title, :description, :priority, :deadline, :category, 'New', :created_by)"
            );
            $taskDetails['created_by'] = $this->userID; 
            $stmt->execute($taskDetails);
            return true;
        } catch (PDOException $e) {
            error_log("Create task error: " . $e->getMessage());
            return false;
        }
    }

    public function editTask(int $taskID, array $updatedDetails): bool {
        try {
            $fields = [];
            foreach ($updatedDetails as $key => $value) {
                $fields[] = "$key = :$key";
            }
            $query = "UPDATE Tasks SET " . implode(', ', $fields) . " WHERE taskID = :taskID";
            $stmt = $this->db->prepare($query);
            $updatedDetails['taskID'] = $taskID;
            return $stmt->execute($updatedDetails);
        } catch (PDOException $e) {
            error_log("Edit task error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteTask(int $taskID): bool {
        try {
            $stmt = $this->db->prepare("DELETE FROM Tasks WHERE taskID = :taskID");
            return $stmt->execute(['taskID' => $taskID]);
        } catch (PDOException $e) {
            error_log("Delete task error: " . $e->getMessage());
            return false;
        }
    }

    public function assignTask(int $taskID, array $employeeIDs): bool {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO Employee_Task_Assignment (employeeID, taskID) VALUES (:employeeID, :taskID)"
            );
            foreach ($employeeIDs as $employeeID) {
                $stmt->execute(['employeeID' => $employeeID, 'taskID' => $taskID]);
            }
            return true;
        } catch (PDOException $e) {
            error_log("Assign task error: " . $e->getMessage());
            return false;
        }
    }

    public function trackProgress(int $taskID): array {
        $stmt = $this->db->prepare(
            "SELECT status FROM Tasks WHERE taskID = :taskID"
        );
        $stmt->execute(['taskID' => $taskID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

class Employee extends User {
    public function viewAssignedTasks(): array {
        $stmt = $this->db->prepare(
            "SELECT t.* FROM Tasks t
             JOIN Employee_Task_Assignment eta ON t.taskID = eta.taskID
             WHERE eta.employeeID = :employeeID"
        );
        $stmt->execute(['employeeID' => $this->userID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTaskStatus(int $taskID, string $status): bool {
        $validStatuses = ['New', 'In Progress', 'Completed', 'On Hold'];

        if (!in_array($status, $validStatuses)) {
            throw new InvalidArgumentException('Invalid status');
        }

        $stmt = $this->db->prepare(
            "UPDATE Tasks SET status = :status WHERE taskID = :taskID"
        );
        return $stmt->execute(['status' => $status, 'taskID' => $taskID]);
    }

    public function setReminder(int $taskID, DateTime $reminderTime): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO Reminders (description, dateTime, taskID, userID)
             VALUES ('Task Reminder', :dateTime, :taskID, :userID)"
        );
        return $stmt->execute([
            'dateTime' => $reminderTime->format('Y-m-d H:i:s'),
            'taskID' => $taskID,
            'userID' => $this->userID
        ]);
    }

    public function collaborateOnTask(int $taskID, string $note): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO Collaboration_Notes (taskID, employeeID, collaborationNote)
             VALUES (:taskID, :employeeID, :collaborationNote)"
        );
        return $stmt->execute([
            'taskID' => $taskID,
            'employeeID' => $this->userID,
            'collaborationNote' => $note
        ]);
    }
}

class Task {
    private int $taskID;
    private string $title;
    private string $description;
    private string $priority;
    private DateTime $deadline;
    private string $category;
    private string $status;
    private array $assignedEmployees = [];
    private PDO $db;

    public function __construct(PDO $db, int $taskID = 0) {
        $this->db = $db;
        $this->taskID = $taskID;

        if ($taskID > 0) {
            $this->loadTaskDetails();
        }
    }

    private function loadTaskDetails(): void {
        $stmt = $this->db->prepare("SELECT * FROM Tasks WHERE taskID = :taskID");
        $stmt->execute(['taskID' => $this->taskID]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($task) {
            $this->title = $task['title'];
            $this->description = $task['description'];
            $this->priority = $task['priority'];
            $this->deadline = new DateTime($task['deadline']);
            $this->category = $task['category'];
            $this->status = $task['status'];
            $this->loadAssignedEmployees();
        }
    }

    private function loadAssignedEmployees(): void {
        $stmt = $this->db->prepare(
            "SELECT e.employeeID, e.username FROM Employees e
             JOIN Employee_Task_Assignment eta ON e.employeeID = eta.employeeID
             WHERE eta.taskID = :taskID"
        );
        $stmt->execute(['taskID' => $this->taskID]);
        $this->assignedEmployees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(): bool {
        try {
            if ($this->taskID === 0) {
                $stmt = $this->db->prepare(
                    "INSERT INTO Tasks (title, description, priority, deadline, category, status, created_by)
                     VALUES (:title, :description, :priority, :deadline, :category, :status, :created_by)"
                );
                $stmt->execute([
                    'title' => $this->title,
                    'description' => $this->description,
                    'priority' => $this->priority,
                    'deadline' => $this->deadline->format('Y-m-d H:i:s'),
                    'category' => $this->category,
                    'status' => $this->status,
                    'created_by' => 1
                ]);
                $this->taskID = $this->db->lastInsertId();
            } else {
                $stmt = $this->db->prepare(
                    "UPDATE Tasks SET title = :title, description = :description, 
                     priority = :priority, deadline = :deadline, category = :category, status = :status
                     WHERE taskID = :taskID"
                );
                $stmt->execute([
                    'title' => $this->title,
                    'description' => $this->description,
                    'priority' => $this->priority,
                    'deadline' => $this->deadline->format('Y-m-d H:i:s'),
                    'category' => $this->category,
                    'status' => $this->status,
                    'taskID' => $this->taskID
                ]);
            }
            return true;
        } catch (PDOException $e) {
            error_log("Save task error: " . $e->getMessage());
            return false;
        }
    }

    public function updateStatus(string $newStatus): bool {
        $validStatuses = ['New', 'In Progress', 'Completed', 'On Hold'];
        if (!in_array($newStatus, $validStatuses)) {
            throw new InvalidArgumentException('Invalid status');
        }

        try {
            $stmt = $this->db->prepare(
                "UPDATE Tasks SET status = :status WHERE taskID = :taskID"
            );
            return $stmt->execute(['status' => $newStatus, 'taskID' => $this->taskID]);
        } catch (PDOException $e) {
            error_log("Update status error: " . $e->getMessage());
            return false;
        }
    }

    public function assignEmployee(int $employeeID): bool {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO Employee_Task_Assignment (employeeID, taskID) VALUES (:employeeID, :taskID)"
            );
            $stmt->execute(['employeeID' => $employeeID, 'taskID' => $this->taskID]);
            $this->assignedEmployees[] = ['employeeID' => $employeeID]; // Update local state
            return true;
        } catch (PDOException $e) {
            error_log("Assign employee error: " . $e->getMessage());
            return false;
        }
    }

    public function getAssignedEmployees(): array {
        return $this->assignedEmployees;
    }
}

class Note {
    private int $noteID;
    private string $content;
    private DateTime $dateCreated;
    private int $taskID;
    private PDO $db;

    public function __construct(PDO $db, int $noteID = 0) {
        $this->db = $db;
        $this->noteID = $noteID;

        if ($noteID > 0) {
            $this->loadNoteDetails();
        }
    }

    private function loadNoteDetails(): void {
        $stmt = $this->db->prepare("SELECT * FROM Notes WHERE noteID = :noteID");
        $stmt->execute(['noteID' => $this->noteID]);
        $note = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($note) {
            $this->content = $note['content'];
            $this->dateCreated = new DateTime($note['dateCreated']);
            $this->taskID = $note['taskID'];
        }
    }

    public function save(string $content, int $taskID): bool {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO Notes (content, dateCreated, taskID) 
                 VALUES (:content, NOW(), :taskID)"
            );
            return $stmt->execute(['content' => $content, 'taskID' => $taskID]);
        } catch (PDOException $e) {
            error_log("Save note error: " . $e->getMessage());
            return false;
        }
    }
}

class Reminder {
    private int $reminderID;
    private string $description;
    private DateTime $dateTime;
    private int $taskID;
    private int $userID;
    private PDO $db;

    public function __construct(PDO $db, int $reminderID = 0) {
        $this->db = $db;
        $this->reminderID = $reminderID;

        if ($reminderID > 0) {
            $this->loadReminderDetails();
        }
    }

    private function loadReminderDetails(): void {
        $stmt = $this->db->prepare("SELECT * FROM Reminders WHERE reminderID = :reminderID");
        $stmt->execute(['reminderID' => $this->reminderID]);
        $reminder = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reminder) {
            $this->description = $reminder['description'];
            $this->dateTime = new DateTime($reminder['dateTime']);
            $this->taskID = $reminder['taskID'];
            $this->userID = $reminder['userID'];
        }
    }

    public function save(string $description, DateTime $dateTime, int $taskID, int $userID): bool {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO Reminders (description, dateTime, taskID, userID) 
                 VALUES (:description, :dateTime, :taskID, :userID)"
            );
            return $stmt->execute([
                'description' => $description,
                'dateTime' => $dateTime->format('Y-m-d H:i:s'),
                'taskID' => $taskID,
                'userID' => $userID
            ]);
        } catch (PDOException $e) {
            error_log("Save reminder error: " . $e->getMessage());
            return false;
        }
    }
}

?>


