<?php
// -------- CONFIGURATION --------
$correct_secret_key = "mySecret123Qasa65gd422@123"; // Change to your secret

// -------- PROCESS DELETION IF FORM SUBMITTED --------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_key = $_POST['secret_key'] ?? '';
    $files_input = $_POST['files'] ?? '';

    // Check secret key
    if ($input_key !== $correct_secret_key) {
        echo "<p style='color:red;'>❌ Invalid secret key.</p>";
    } else {
        echo "<h3>File Deletion Report</h3>";

        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $files = array_filter(array_map('trim', explode("\n", $files_input)));

        foreach ($files as $file_name) {
            $full_path = $document_root . '/' . ltrim($file_name, '/');

            if (file_exists($full_path)) {
                if (unlink($full_path)) {
                    echo "✅ Deleted: <strong>$file_name</strong><br>";
                } else {
                    echo "⚠️ Could not delete: <strong>$file_name</strong> (permission issue)<br>";
                }
            } else {
                echo "❌ Not found: <strong>$file_name</strong><br>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Files Safely</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            background-color: #f9f9f9;
        }
        textarea, input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<h2>🧹 File Deletion Panel</h2>

<form method="POST">
    <label for="files">Enter file names to delete (one per line, from root):</label>
    <textarea name="files" rows="6" placeholder="e.g. delete.me&#10;old_script.php" required></textarea>

    <label for="secret_key">Enter Secret Key:</label>
    <input type="password" name="secret_key" required placeholder="Your secret key">

    <input type="submit" value="Delete Files">
</form>

</body>
</html>
