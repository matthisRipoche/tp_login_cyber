<?php
class User
{
    private $conn;
    private $table_name = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($name, $mail, $password)
    {
        if ($this->nameExists($name)) {
            return ["status" => "danger", "message" => "Le nom est déjà utilisé !"];
        }
        if ($this->emailExists($mail)) {
            return ["status" => "danger", "message" => "L'email est déjà utilisé !"];
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO " . $this->table_name . " (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $mail);
        $stmt->bindParam(":password", $hashed_password);

        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Inscription réussie !"];
        } else {
            return ["status" => "danger", "message" => "Une erreur est survenue."];
        }
    }

    private function emailExists($mail)
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $mail);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    private function nameExists($name)
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
