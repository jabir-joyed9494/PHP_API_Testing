<?php
require_once '../config/database.php';

$database = new Database();
$conn = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $query = "DELETE FROM users WHERE id=:id";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([":id"=> $data->id])) {
        echo json_encode(["message" => "User deleted successfully"]);
    } else {
        echo json_encode(["message" => "User deletion failed"]);
    }
} else {
    echo json_encode(["message" => "Invalid ID"]);
}
?>
