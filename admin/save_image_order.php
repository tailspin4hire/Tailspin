<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['order'])) {
    foreach ($data['order'] as $position => $image_id) {
        $stmt = $pdo->prepare("UPDATE product_images SET sort_order = ? WHERE image_id = ?");
        $stmt->execute([$position, $image_id]);
    }
    echo "Image order saved!";
} else {
    echo "No image order received.";
}
