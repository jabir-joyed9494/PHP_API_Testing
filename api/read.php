<?php
require_once '../config/database.php';

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT * FROM users";
$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);
?>
