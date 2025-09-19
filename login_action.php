<?php
require_once 'config.php'; // assumes PDO connection in $pdo

header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check request method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and fetch inputs
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password'] ?? '');

    // Validate input
    if (empty($email) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Email and password are required."]);
        exit;
    }

    try {
        // Prepare and execute query
        $stmt = $pdo->prepare("SELECT vendor_id,business_name, password, user_role FROM vendors WHERE business_email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['vendor_id'] = $user['vendor_id'];
            $_SESSION['user_role'] = $user['user_role'];
            $_SESSION['username'] = $user['business_name'];

            echo json_encode([
                "success" => true,
                "message" => "Login successful.",
                "role" => $user['user_role']
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Invalid email or password."
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "success" => false,
            "message" => "Server error. Please try again later."
        ]);
    }

    exit;
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
    exit;
}
?>
