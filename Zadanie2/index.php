<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

require 'user.php';
require 'auth.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

switch ($requestMethod) {
    case 'POST':
        if ($requestUri[0] === 'users') {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = createUser($data);
            echo json_encode($user);
        } elseif ($requestUri[0] === 'login') {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = authenticateUser($data['username'], $data['password']);
            echo json_encode($user ? $user : ['error' => 'Invalid credentials']);
        }
        break;

    case 'GET':
        if ($requestUri[0] === 'users' && isset($requestUri[1])) {
            $user = getUser($requestUri[1]);
            echo json_encode($user ? $user : ['error' => 'User not found']);
        }
        break;

    case 'PUT':
        if ($requestUri[0] === 'users' && isset($requestUri[1])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = updateUser($requestUri[1], $data);
            echo json_encode($user ? $user : ['error' => 'User not found']);
        }
        break;

    case 'DELETE':
        if ($requestUri[0] === 'users' && isset($requestUri[1])) {
            $result = deleteUser($requestUri[1]);
            echo json_encode(['success' => (bool)$result]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
}


?>