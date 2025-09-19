<?php
header("Content-Type: application/json");

// Optional: Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php'; // Ensure your DB connection is correct

try {
    // Read POST data as arrays directly (from FormData)
    $types     = isset($_POST['types'])     ? $_POST['types']     : [];
    $models    = isset($_POST['models'])    ? $_POST['models']    : [];
    $years     = isset($_POST['years'])     ? $_POST['years']     : [];
    $locations = isset($_POST['locations']) ? $_POST['locations'] : [];

    // Start with base query
    $query = "SELECT a.*, 
                     (SELECT GROUP_CONCAT(image_url ORDER BY sort_order ASC) 
                      FROM product_images 
                      WHERE product_id = a.aircraft_id AND product_type = 'aircraft') AS images
              FROM aircrafts a 
              WHERE a.status = 'approved'";
    
    $params = [];
    $conditions = [];

    // Apply filters dynamically
    if (!empty($types)) {
        $placeholders = implode(',', array_fill(0, count($types), '?'));
        $conditions[] = "a.aircraft_type IN ($placeholders)";
        $params = array_merge($params, $types);
    }

    if (!empty($models)) {
        $placeholders = implode(',', array_fill(0, count($models), '?'));
        $conditions[] = "a.model IN ($placeholders)";
        $params = array_merge($params, $models);
    }

    if (!empty($years)) {
        $placeholders = implode(',', array_fill(0, count($years), '?'));
        $conditions[] = "a.year IN ($placeholders)";
        $params = array_merge($params, $years);
    }

    if (!empty($locations)) {
        $placeholders = implode(',', array_fill(0, count($locations), '?'));
        $conditions[] = "a.location IN ($placeholders)";
        $params = array_merge($params, $locations);
    }

    // Add conditions to query if any
    if (!empty($conditions)) {
        $query .= " AND " . implode(" AND ", $conditions);
    }

    $query .= " ORDER BY a.created_at DESC";

    // Prepare and execute
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $aircrafts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return data
    echo json_encode($aircrafts);
} catch (Exception $e) {
    echo json_encode(["error" => "Error fetching aircraft: " . $e->getMessage()]);
}
?>
