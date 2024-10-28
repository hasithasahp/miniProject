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
        echo 'Retrive students';
        break;
        
    case 'POST':
        echo 'Create new Student';
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