<?php
// Database connection
$host = 'localhost'; // Database host
$db_name = 'tailspin_aircraft_marketplace'; // Database name
$username = 'tailspin_aircrat_marketplace'; // Database username
$password = 'aircraft@786'; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $status = $_POST['status'] ?? 'active';
    $role = $_POST['role'] ?? 'Regular Admin'; // Use ENUM values
    $created_at = date('Y-m-d H:i:s');

    // Handle profile picture
    $profile_picture = '';
    if (!empty($_FILES['profile_picture']['name'])) {
        $targetDir = 'uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $filename = time() . '_' . basename($_FILES['profile_picture']['name']);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
            $profile_picture = $targetFile;
        }
    }

    // Insert query
    $stmt = $pdo->prepare("INSERT INTO admins (name, email, profile_picture, password, status, created_at, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $profile_picture, $password, $status, $created_at, $role]);

    echo "<div style='color: green;'>✅ Admin added successfully!</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f1f1f1; }
        form { background: #fff; padding: 20px; max-width: 500px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        label { margin-top: 10px; display: block; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { padding: 10px 15px; margin-top: 15px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Add New Admin</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <label>Profile Picture:</label>
    <input type="file" name="profile_picture">

    <label>Status:</label>
    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <label>Role:</label>
    <select name="role" required>
        <option value="Super Admin">Super Admin</option>
        <option value="Regular Admin">Regular Admin</option>
        <option value="SEO Admin">SEO Admin</option>
    </select>

    <button type="submit">Add Admin</button>
</form>

</body>
</html>

