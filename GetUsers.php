<?php
require_once "classes/Database.php";

class GetUsers
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function fetchUsers()
    {
        header("Content-Type: application/json");

        $query = "SELECT id, name, email FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($users);
    }
}

$users = new GetUsers();
$users->fetchUsers();
