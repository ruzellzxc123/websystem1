
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

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Include database configuration
require_once '../CONFIG/database.php';

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

$email = $input['email'] ?? '';
$password = $input['password'] ?? '';

// Validate input
if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required']);
    exit;
}

try {
    // Check if database connection works
    if (!isset($pdo) || !$pdo) {
        echo json_encode([
            'success' => false, 
            'message' => 'Database connection not established. Please check database configuration.'
        ]);
        exit;
    }
    
    // Prepare and execute query
    $stmt = $pdo->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Check if user exists
    if (!$user) {
        echo json_encode([
            'success' => false, 
            'message' => 'User not found. Please register first.'
        ]);
        exit;
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        echo json_encode([
            'success' => false, 
            'message' => 'Invalid password. Please try again.'
        ]);
        exit;
    }
    
    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['logged_in'] = true;
    
    // Login successful
    echo json_encode([
        'success' => true, 
        'message' => 'Login successful',
        'user' => ['id' => $user['id'], 'email' => $user['email']]
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Database error: ' . $e->getMessage()
    ]);
    error_log("Login error: " . $e->getMessage());
}

