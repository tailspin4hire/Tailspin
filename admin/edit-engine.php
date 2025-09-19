<?php
ob_start();
include "header.php";
include "config.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Check if engine_id is set
if (!isset($_GET['engine_id'])) {
    header("Location: admin-engines.php");
    exit;
}

$engine_id = $_GET['engine_id'];

// Fetch engine details
$stmt = $pdo->prepare("SELECT * FROM engines WHERE engine_id = ?");
$stmt->execute([$engine_id]);
$engine = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch existing images
$image_stmt = $pdo->prepare("
    SELECT image_id AS image_id, image_url 
    FROM product_images 
    WHERE product_id = ? AND product_type = 'engine' 
    ORDER BY sort_order ASC
");
$image_stmt->execute([$engine_id]);
$images = $image_stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$engine) {
    echo "<p>Engine not found.</p>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $model = $_POST['model'];
        $manufacturer = $_POST['manufacturer'];
        $location = $_POST['location'];
        $engine_type = $_POST['engine_type'];
        $power_thrust = $_POST['power_thrust'];
        $year = $_POST['year'];
        $total_time_hours = $_POST['total_time_hours'];
        $hr = $_POST['hr'];
        $cycles = $_POST['cycles'];
        $condition = $_POST['condition'];
        $price = $_POST['price'];
        $tags = $_POST['tags'];
        $extra_details = $_POST['extra_details'];
        $warranty = $_POST['warranty'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("
            UPDATE engines 
            SET model = ?, manufacturer = ?, location = ?, engine_type = ?, power_thrust = ?, year = ?, 
                total_time_hours = ?, hr = ?, cycles = ?, `condition` = ?, price = ?, tags = ?, 
                extra_details = ?, warranty = ?, status = ? 
            WHERE engine_id = ?
        ");
        
        if ($stmt->execute([
            $model, $manufacturer, $location, $engine_type, $power_thrust, $year, 
            $total_time_hours, $hr, $cycles, $condition, $price, $tags, 
            $extra_details, $warranty, $status, $engine_id
        ])) {
            
              if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = "../vendors/uploads/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $fileName = time() . "_" . basename($_FILES['images']['name'][$key]);
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($tmp_name, $filePath)) {
                    $stmt = $pdo->prepare("INSERT INTO product_images (product_id, product_type, image_url, created_at) VALUES (?, 'engine', ?, NOW())");
                    $stmt->execute([$engine_id, $filePath]);
                }
            }
             }
            
            header("Location: engines-listing.php?vendor_id=" . $engine['vendor_id']);
            exit;
        } else {
            $error = "Failed to update engine.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}


 ?>


<head>
    <style>
     .photo-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
  gap: 15px;
}

.photo-item {
  position: relative;
  width: 100%;
}

/* Default small image */
.photo-item img {
  width: 100%;
  height: 100px;
  object-fit: cover;
  border-radius: 8px;
}

/* Main image spans more grid space */
.main-photo {
  grid-column: span 3;   /* Span 3 columns */
  grid-row: span 2;      /* Span 2 rows */
}

.main-photo img {
  width: 100%;
  height: 100%;
  min-height: 300px;
  object-fit: cover;
  border: 2px solid red;
  border-radius: 8px;
}

.main-label {
  position: absolute;
  bottom: 10px;
  left: 10px;
  background-color: #ccc;
  color: #333;
  font-size: 14px;
  padding: 3px 10px;
  border-radius: 12px;
}
.add-photo {
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f5f5f5;
  border: 2px dashed #ccc;
  border-radius: 8px;
  height: 100px;
  cursor: pointer;
  text-align: center;
  color: #888;
}

.add-photo:hover {
  background: #eee;
}

    </style>
</head>
<div class="main-panel">
    <div class="content-wrapper">
        <h3 class="text-center">Edit Engine</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" class="form-container">
            <div class="row">
                <div class="col-md-6">
                    <label>Model</label>
                    <input type="text" class="form-control" name="model" value="<?= htmlspecialchars($engine['model']); ?>" required>

                    <label>Manufacturer</label>
                    <input type="text" class="form-control" name="manufacturer" value="<?= htmlspecialchars($engine['manufacturer']); ?>">

                    <label>Location</label>
                    <input type="text" class="form-control" name="location" value="<?= htmlspecialchars($engine['location']); ?>">

                    <label>Engine Type</label>
                    <input type="text" class="form-control" name="engine_type" value="<?= htmlspecialchars($engine['engine_type']); ?>">

                    <label>Power/Thrust</label>
                    <input type="text" class="form-control" name="power_thrust" value="<?= htmlspecialchars($engine['power_thrust']); ?>">

                    <label>Year</label>
                    <input type="number" class="form-control" name="year" value="<?= htmlspecialchars($engine['year']); ?>">
                </div>

                <div class="col-md-6">
                    <label>Total Time (Hours)</label>
                    <input type="text" class="form-control" name="total_time_hours" value="<?= htmlspecialchars($engine['total_time_hours']); ?>">

                    <label>HR</label>
                    <input type="text" class="form-control" name="hr" value="<?= htmlspecialchars($engine['hr']); ?>">

                    <label>Cycles</label>
                    <input type="number" class="form-control" name="cycles" value="<?= htmlspecialchars($engine['cycles']); ?>">

                    <label>Condition</label>
                    <input type="text" class="form-control" name="condition" value="<?= htmlspecialchars($engine['condition']); ?>">

                    <label>Price ($)</label>
                    <input type="text" class="form-control" name="price" value="<?= htmlspecialchars($engine['price']); ?>">

                    <label>Tags</label>
                    <input type="text" class="form-control" name="tags" value="<?= htmlspecialchars($engine['tags']); ?>">
                </div>
            </div>

            <label>Extra Details</label>
            <textarea class="form-control" name="extra_details"><?= htmlspecialchars($engine['extra_details']); ?></textarea>

            <label>Warranty</label>
            <textarea class="form-control" name="warranty"><?= htmlspecialchars($engine['warranty']); ?></textarea>

            <label>Status</label>
            <select class="form-control" name="status">
                <option value="pending" <?= $engine['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="approved" <?= $engine['status'] == 'approved' ? 'selected' : ''; ?>>Approved</option>
                <option value="rejected" <?= $engine['status'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
            </select>

           
               <div class="form-group">
    <label for="images">Engine Images</label>
    <input type="file" class="form-control" id="images" name="images[]" multiple>

    <?php if (!empty($images)): ?>
        <div id="sortable-engine-images" class="photo-grid mt-4">
            <?php foreach ($images as $index => $img): ?>
                <div class="photo-item<?= $index === 0 ? ' main-photo' : '' ?>" data-id="<?= $img['image_id']; ?>">
                    <img src="../vendors/<?= htmlspecialchars($img['image_url']); ?>" alt="Engine Image" style="max-width: 100%; height: auto;">
                    <?php if ($index === 0): ?>
                        <div class="main-label">Main</div>
                        <div class="photo-warning">Must be over 500 pixels wide</div>
                    <?php endif; ?>
                    <a href="delete_image.php?id=<?= $img['image_id']; ?>&engine_id=<?= $engine_id ?>" class="btn btn-sm btn-danger mt-1">Delete</a>
                </div>
            <?php endforeach; ?>

            <div class="photo-item add-photo">
                <label for="add-engine-photo">
                    <span>&#128247;</span><br>Add
                </label>
                <input type="file" name="images[]" id="add-engine-photo" style="display: none;" multiple>
            </div>
        </div>

        <button type="button" class="btn btn-success mt-3" onclick="saveEngineImageOrder()">Save Image Order</button>
    <?php else: ?>
        <p>No images uploaded.</p>
    <?php endif; ?>
</div>
 <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Update Engine</button>
                <a href="engines-listing.php?vendor_id=<?= htmlspecialchars($engine['vendor_id']); ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = document.getElementById('sortable-engine-images');

    if (grid) {
        new Sortable(grid, {
            animation: 150,
            filter: '.add-photo',
            draggable: '.photo-item:not(.add-photo)',
            onEnd: function () {
                updateEngineMainLabel();
            }
        });

        updateEngineMainLabel();
    }
});

// Get sorted image IDs
function getEngineSortedIds() {
    return [...document.querySelectorAll('#sortable-engine-images .photo-item:not(.add-photo)')]
        .map(item => item.dataset.id);
}

// Save order to server
function saveEngineImageOrder() {
    const ids = getEngineSortedIds();

    if (ids.length === 0) {
        alert("No engine images to sort.");
        return;
    }

    fetch('save_engine_image_order.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({order: ids, type: 'engine'}) // Pass type to differentiate on backend
    })
    .then(response => response.text())
    .then(result => alert(result))
    .catch(error => {
        console.error(error);
        alert('Error saving engine image order.');
    });
}

// Update Main label
function updateEngineMainLabel() {
    const items = document.querySelectorAll('#sortable-engine-images .photo-item:not(.add-photo)');

    items.forEach((item, index) => {
        item.querySelectorAll('.main-label, .photo-warning').forEach(el => el.remove());
        item.classList.remove('main-photo');

        if (index === 0) {
            item.classList.add('main-photo');
            const label = document.createElement('div');
            label.className = 'main-label';
            label.textContent = 'Main';
            item.appendChild(label);

            const warning = document.createElement('div');
            warning.className = 'photo-warning';
            warning.textContent = 'Must be over 500 pixels wide';
            item.appendChild(warning);
        }
    });
}
</script>


<?php include "footer.php"; ?>
