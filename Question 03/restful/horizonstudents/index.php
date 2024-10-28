<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers for CORS and content type
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include database and student model
include_once '../config/Database.php';
include_once '../models/Student.php';

// Initialize database and student object
$database = new Database();
$db = $database->getConnection();

$students = new Student($db);

// Parse the request method
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        if(isset($_GET['id'])) {
            $students->id = $_GET['id'];
            $students->readSingle();
        } else {
            $students->read();
        }
        break;
        
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        if($data) {
            $students->firstName = $data['first_name'] ?? null;
            $students->lastName = $data['last_name'] ?? null;
            $students->city = $data['city'] ?? null;
            $students->district = $data['district'] ?? null;
            $students->province = $data['province'] ?? null;
            $students->email = $data['email_address'] ?? null;
            $students->contact = $data['mobile_number'] ?? null;

            $students->create();
            echo json_encode([
                "message" => "Data received successfully",
                "name" => $students->firstName . " " . $students->lastName,
                "email" => $students->email
            ]);
        } else {
            echo json_encode(["error" => "Invalid JSON input"]);
        }
        break;
        
    case 'PUT':
        echo 'Update a Student';
        break;
        
    case 'DELETE':
        echo 'Delete a Student';
        break;
    
    default:
        http_response_code(405);
        echo json_encode(["message" => 'Method Not Allowed']);
        break;
}
?>