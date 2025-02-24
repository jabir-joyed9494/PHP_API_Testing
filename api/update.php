<?php
require_once '../config/database.php';

$database = new Database();
$conn = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {

    $query = "UPDATE users SET name=:name, email=:email, phone=:phone WHERE id=:id";
    $stmt = $conn->prepare($query);
    
    $success = $stmt->execute([
        ":id" => $data->id,
        ":name" => $data->name,
        ":email" => $data->email,
        ":phone" => $data->phone
    ]);
    
    if ($success) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update user"]);
    }
    


} else {
    echo json_encode(["message" => "Invalid ID"]);
}
?>
