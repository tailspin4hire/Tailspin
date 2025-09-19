<?php
require_once 'config.php';

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST['email'] ?? '';
        $business_name = $_POST['username'] ?? '';
        $business_phone = $_POST['business_phone'] ?? '';
        $business_phone_code = $_POST['business_phone_code'] ?? '';
        $password_raw = $_POST['password'] ?? '';
        $password_hashed = password_hash($password_raw, PASSWORD_BCRYPT);

        $services = isset($_POST['services']) ? $_POST['services'] : [];
        $selected_services = implode(", ", $services);

        $owns_aircraft = $_POST['own_aircraft'] ?? 'no';
        $aircraft_type = !empty($_POST['aircraft_type']) ? $_POST['aircraft_type'] : null;

        $looking_to_buy_or_sell = $_POST['buy_sell_aircraft'] ?? 'no';

        $user_role = 'client';
        if (count($services) > 1 || !empty(array_diff($services, ["Aircraft for Sale"]))) {
            $user_role = 'vendor';
        }

        // Check if email already exists
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM vendors WHERE business_email = :email");
        $checkStmt->execute([':email' => $email]);

        if ($checkStmt->fetchColumn() > 0) {
            header("Location: register.php?error=email_exists");
            exit;
        }

        // Insert new user
                   // Insert new user
            $stmt = $pdo->prepare("INSERT INTO vendors (
               business_name, business_phone,business_phone_code, business_email,  password,
                user_role, selected_services, owns_aircraft, aircraft_type, looking_to_buy_or_sell, status, created_at
            ) VALUES (
            :business_name, :business_phone, :business_phone_code,
                :business_email, :password,
                :user_role, :selected_services, :owns_aircraft, :aircraft_type, :looking_to_buy_or_sell, :status, NOW()
            )");
            
            $stmt->execute([
                ':business_name' => $business_name,
                ':business_phone' => $business_phone,
                ':business_phone_code' => $business_phone_code,
                ':business_email' => $email,
                ':password' => $password_hashed,
                ':user_role' => $user_role,
                ':selected_services' => $selected_services,
                ':owns_aircraft' => $owns_aircraft,
                ':aircraft_type' => $aircraft_type,
                ':looking_to_buy_or_sell' => $looking_to_buy_or_sell,
                ':status' => 'active'
            ]);


        // Retrieve the inserted user
        $userStmt = $pdo->prepare("SELECT vendor_id, business_name, password, user_role FROM vendors WHERE business_email = :email LIMIT 1");
        $userStmt->execute([':email' => $email]);
        $user = $userStmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password_raw, $user['password'])) {
            session_start();
            $_SESSION['vendor_id'] = $user['vendor_id'];
            $_SESSION['user_role'] = $user['user_role'];
            $_SESSION['username'] = $user['business_name'];

            // Redirect based on role
            if ($user['user_role'] === 'client') {
                header("Location: clients/index.php");
            } elseif ($user['user_role'] === 'vendor') {
                header("Location: vendors/index.php");
            } else {
                header("Location: login.php?error=unknown_role");
            }
            exit;
        } else {
            header("Location: login.php?error=login_failed");
            exit;
        }
    }
} catch (Exception $e) {
    header("Location: register.php?error=" . urlencode($e->getMessage()));
    exit;
}
?>
