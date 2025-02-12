<?php
require_once "classes/Database.php";
require_once "classes/User.php";

header("Content-Type: application/json");

// Lire le JSON brut envoyé par fetch()
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($data["name"], $data["mail"], $data["password"])) {
        echo json_encode(["status" => "danger", "message" => "Données manquantes."]);
        exit;
    }

    $name = htmlspecialchars($data["name"]);
    $mail = filter_var($data["mail"], FILTER_VALIDATE_EMAIL);
    $password = $data["password"];

    // Vérif email valide
    if (!$mail) {
        echo json_encode(["status" => "danger", "message" => "Email invalide."]);
        exit;
    }

    // Vérif longueur du mot de passe
    if (strlen($password) < 12) {
        echo json_encode(["status" => "danger", "message" => "Le mot de passe doit contenir au moins 12 caractères."]);
        exit;
    }

    // Vérif de complexité du mot de passe
    if (!preg_match("#[a-z]+#", $password) || !preg_match("#[A-Z]+#", $password) || !preg_match("#[0-9]+#", $password) || !preg_match("#\W+#", $password)) {
        echo json_encode(["status" => "danger", "message" => "Le mot de passe doit contenir une minuscule, une majuscule, un chiffre et un caractère spécial."]);
        exit;
    }

    // Connexion à la base de données et enregistrement
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $result = $user->register($name, $mail, $password);
    echo json_encode($result);
}
