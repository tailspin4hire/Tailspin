<?php
require 'config.php'; // Database connection

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$response = [];

if (!isset($_POST['services']) || empty($_POST['services'])) {
    echo json_encode(["error" => "No services selected."]);
    exit;
}

$selectedServices = json_decode($_POST['services'], true);
if (!is_array($selectedServices)) {
    echo json_encode(["error" => "Invalid service type format."]);
    exit;
}

try {
    $placeholders = implode(',', array_fill(0, count($selectedServices), '?'));

    $sql = "
        SELECT 
            s.id, s.vendor_id, s.service_type, s.ratings, s.email, s.photos, 
            s.business_name,s.website,s.country, v.business_phone, v.business_email ,v.business_name
        FROM services s
        LEFT JOIN vendors v ON s.vendor_id = v.vendor_id
        WHERE s.service_type IN ($placeholders)
        ORDER BY s.service_type ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($selectedServices);

    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($services)) {
        echo json_encode(["error" => "No matching services found."]);
    } else {
        echo json_encode($services);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
