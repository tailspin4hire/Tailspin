<?php
require 'config.php';

header('Content-Type: application/json');

try {
    $conditions = isset($_POST['conditions']) ? json_decode($_POST['conditions'], true) : [];
    $locations = isset($_POST['locations']) ? json_decode($_POST['locations'], true) : [];
    $manufacturers = isset($_POST['manufacturers']) ? json_decode($_POST['manufacturers'], true) : [];
    $engineTypes = isset($_POST['engineTypes']) ? json_decode($_POST['engineTypes'], true) : [];

    $query = "SELECT e.*, 
       (
         SELECT GROUP_CONCAT(image_url ORDER BY sort_order ASC) 
         FROM product_images 
         WHERE product_id = e.engine_id AND product_type = 'engine'
       ) AS images
FROM engines e 
WHERE e.status = 'approved';
";

    $params = [];

    if (!empty($conditions)) {
        $placeholders = implode(',', array_fill(0, count($conditions), '?'));
        $query .= " AND e.condition IN ($placeholders)";
        $params = array_merge($params, $conditions);
    }

    if (!empty($locations)) {
        $placeholders = implode(',', array_fill(0, count($locations), '?'));
        $query .= " AND e.location IN ($placeholders)";
        $params = array_merge($params, $locations);
    }

    if (!empty($manufacturers)) {
        $placeholders = implode(',', array_fill(0, count($manufacturers), '?'));
        $query .= " AND e.manufacturer IN ($placeholders)";
        $params = array_merge($params, $manufacturers);
    }

    if (!empty($engineTypes)) {
        $placeholders = implode(',', array_fill(0, count($engineTypes), '?'));
        $query .= " AND e.engine_type IN ($placeholders)";
        $params = array_merge($params, $engineTypes);
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $engines = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($engines)) {
        echo json_encode(["message" => "No engines found."]); // Ensure response is always JSON
        exit;
    }

    echo json_encode($engines);
} catch (Exception $e) {
    echo json_encode(["error" => "Error fetching search results: " . $e->getMessage()]);
}
?>
