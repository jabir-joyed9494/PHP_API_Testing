<?php
require_once '../config/database.php';

$database = new Database();
$conn = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));
var_dump($data);

if (!empty($data->name) && !empty($data->email) && !empty($data->phone)) {
    $query = "INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":phone", $data->phone);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User created successfully"]);
    } else {
        echo json_encode(["message" => "User creation failed"]);
    }
} 
else {
    echo json_encode(["message" => "Incomplete data"]);
}
?>
