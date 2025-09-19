<?php
require 'config.php';

try {
    $stmt = $pdo->prepare("
        SELECT s.id, s.service_type, s.photos, s.ratings,s.business_name, s.email,s.country,s.website, s.phone_number, v.business_email ,v.business_name
        FROM services s
        JOIN vendors v ON s.vendor_id = v.vendor_id
    ");
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($services as &$service) {
        $photos = json_decode($service['photos'], true); // Decode JSON
        $service['photo'] = (!empty($photos) && is_array($photos)) ? $photos[0] : 'default.jpg'; // Get first image or use default
    }

    echo json_encode($services);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
