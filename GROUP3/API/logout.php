<?php
session_start();

header('Content-Type: application/json');

// Enable CORS for development
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Destroy session
$_SESSION = array();
session_destroy();

echo json_encode([
    'success' => true, 
    'message' => 'Logout successful'
]);

