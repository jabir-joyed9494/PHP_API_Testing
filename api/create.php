<?php
require_once '../config/database.php';

$database = new Database();
$conn = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));
var_dump($data);

if (!empty($data->name) && !empty($data->email) && !empty($data->phone)) {

    $stmt = $conn->prepare("INSERT INTO users (name,email,phone) VALUES(?,?,?)");
    $stmt->execute([$data->name, $data->email, $data->phone]);
} 
else {
    echo json_encode(["message" => "Incomplete data"]);
}
?>
