<?php
class User {
    private $conn;
    private $table_name = "users";

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new user
    public function createUser($matric, $name, $password, $role) {
        // Check if user already exists
        $sql = "SELECT * FROM " . $this->table_name . " WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $matric);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return "Error: User with matric $matric already exists.";
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }

        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $sql = "INSERT INTO " . $this->table_name . " (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", $matric, $name, $password, $role);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // Read all users
    public function getUsers() {
        $sql = "SELECT matric, name, role FROM " . $this->table_name;
        $result = $this->conn->query($sql);
        return $result;
    }

    // Read a single user by matric
    public function getUser($matric) {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $matric);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                return $user;
            } else {
                return "Error fetching user: " . $this->conn->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // Update a user's information
    public function updateUser($matric, $name, $role) {
        $sql = "UPDATE " . $this->table_name . " SET name = ?, role = ? WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $name, $role, $matric);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // Delete a user by matric
    public function deleteUser($matric) {
        $sql = "DELETE FROM " . $this->table_name . " WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $matric);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}
?>
