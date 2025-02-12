<?php
require_once "classes/Database.php";

header("Content-Type: application/json");

// Récupération des données envoyées en JSON
$data = json_decode(file_get_contents("php://input"), true);

// Vérification des données
if (!isset($data["id"])) {
    echo json_encode(["status" => "danger", "message" => "ID utilisateur manquant"]);
    exit;
}

$userId = intval($data["id"]);

$database = new Database();
$db = $database->getConnection();

// Suppression de l'utilisateur
$query = "DELETE FROM users WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(":id", $userId);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Utilisateur supprimé avec succès"]);
} else {
    echo json_encode(["status" => "danger", "message" => "Erreur lors de la suppression"]);
}
