<?php 
require_once 'config.php';

$query = strtolower(trim($_GET['q'] ?? ''));
if (!$query) {
    echo json_encode([]);
    exit;
}

$results = [];
$seen = [];

// ========================
// Search in aircraft_models
// ========================
$stmt = $pdo->prepare("
    SELECT grouped_model_display_names, model, manufacturer, aircraft_type, type_designator, model_types
    FROM aircraft_models
    WHERE LOWER(grouped_model_display_names) LIKE :q
       OR LOWER(model) LIKE :q
       OR LOWER(model_types) LIKE :q
       OR LOWER(manufacturer) LIKE :q
       OR LOWER(aircraft_type) LIKE :q
       OR LOWER(type_designator) LIKE :q
    ORDER BY grouped_model_display_names ASC, manufacturer ASC, model ASC
");
$stmt->execute(['q' => "%$query%"]);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $category = trim($row['grouped_model_display_names']);
    $model = trim($row['model']);
    $manufacturer = trim($row['manufacturer']);
    $designator = trim($row['type_designator']);

    // ✅ Category - Treat similar to type_designator
    if ($category && !isset($seen['cat_'.$category])) {
        $seen['cat_'.$category] = true;
        $results[] = [
            'name' => ucwords($category),
            'url'  => "/aircraft?category=" . urlencode($category),
            'type' => 'category'
        ];
    }

    // ✅ Manufacturer
    if ($manufacturer && !isset($seen['man_'.$manufacturer])) {
        $seen['man_'.$manufacturer] = true;
        $results[] = [
            'name' => ucwords($manufacturer),
            'url'  => "/aircraft?manufacture=" . urlencode($manufacturer),
            'type' => 'manufacturer'
        ];
    }

    // ✅ Type Designator
    if ($designator && !isset($seen['des_'.$designator])) {
        $seen['des_'.$designator] = true;
        $results[] = [
            'name' => strtoupper($designator),
            'url'  => "/aircraft?type_designator=" . urlencode($designator),
            'type' => 'type_designator'
        ];
    }

    // ✅ Model
    $modelName = $manufacturer . ' ' . $model;
    if ($model && !isset($seen['model_'.$modelName])) {
        $seen['model_'.$modelName] = true;
        $results[] = [
            'name' => ucwords($modelName),
            'url'  => "/aircraft?model=" . urlencode($model),
            'type' => 'model'
        ];
    }

    if (count($results) >= 50) break; // Limit early if necessary
}

// ========================
// Search in engines
// ========================
$stmt = $pdo->prepare("SELECT engine_id, model FROM engines WHERE LOWER(model) LIKE ? LIMIT 50");
$stmt->execute(["%$query%"]);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $model = strtolower($row['model']);
    if (!isset($seen['engine_' . $model])) {
        $seen['engine_' . $model] = true;
        $results[] = [
            'name' => ucwords($row['model']),
            'url'  => "/engine?model=" . urlencode($row['model']),
            'type' => 'engine'
        ];
    }
    if (count($results) >= 50) break;
}

// ========================
// Search in parts
// ========================
$stmt = $pdo->prepare("
    SELECT part_id, part_name, part_number 
    FROM parts 
    WHERE LOWER(part_name) LIKE ? OR LOWER(part_number) LIKE ? 
    LIMIT 50
");
$stmt->execute(["%$query%", "%$query%"]);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $key = strtolower($row['part_name']) . '_' . strtolower($row['part_number']);
    if (!isset($seen['part_' . $key])) {
        $seen['part_' . $key] = true;
        $results[] = [
            'name' => ucwords($row['part_name']) . " ({$row['part_number']})",
            'url'  => "/parts?name=" . urlencode($row['part_name']),
            'type' => 'part'
        ];
    }
    if (count($results) >= 50) break;
}

// ========================
// Output Final Result
// ========================
header('Content-Type: application/json');
echo json_encode($results);
