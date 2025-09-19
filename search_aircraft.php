<?php
header("Content-Type: application/json");
require_once "config.php"; 

$category = isset($_POST["category"]) ? trim($_POST["category"]) : "";
$model = isset($_POST["model"]) ? trim($_POST["model"]) : "";

// Base Query
$sql = "SELECT a.* FROM aircrafts a WHERE a.status = 'approved' AND a.deleted_at IS NULL";
$params = [];

// Dynamic Filtering
if (!empty($category)) {
    $sql .= " AND LOWER(a.aircraft_type) = LOWER(:category)";
    $params[":category"] = $category;
}

if (!empty($model)) {
    $sql .= " AND LOWER(a.model) LIKE LOWER(:model)";
    $params[":model"] = "%$model%";
}

// Execute Query
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$aircrafts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Images for Each Aircraft
foreach ($aircrafts as &$aircraft) {
    $aircraft_id = $aircraft["aircraft_id"];
    $img_stmt = $pdo->prepare("SELECT image_url FROM product_images WHERE product_id = ? AND product_type = 'aircraft' ORDER BY sort_order ASC");
    $img_stmt->execute([$aircraft_id]);
    $aircraft["images"] = $img_stmt->fetchAll(PDO::FETCH_COLUMN);
}
//ORDER BY sort_order ASC ORDER BY image_id ASC
// Return JSON Response
echo json_encode($aircrafts, JSON_PRETTY_PRINT);
?>
