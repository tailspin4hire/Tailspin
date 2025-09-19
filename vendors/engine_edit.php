<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "header.php";
include "config.php";

// Ensure user is logged in
if (!isset($_SESSION['vendor_id'])) {
    header("Location: ../login.php");
    exit();
}

$vendor_id = $_SESSION['vendor_id'];
$engine_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch engine details
$query = $pdo->prepare("SELECT * FROM engines WHERE engine_id = ? AND vendor_id = ?");
$query->execute([$engine_id, $vendor_id]);
$engine = $query->fetch(PDO::FETCH_ASSOC);

if (!$engine) {
    echo "<script>alert('Engine not found or you do not have permission to edit it.'); window.location.href = 'engine_list.php';</script>";
    exit();
}

// Fetch engine images
$image_query = $pdo->prepare("SELECT image_url FROM product_images WHERE product_id = ? AND product_type = 'engine'");
$image_query->execute([$engine_id]);
$images = $image_query->fetchAll(PDO::FETCH_COLUMN, 0);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $extra_details = $_POST['extra_details'];
    $warranty = $_POST['warranty'];
    
    // Update engine details
   $update_query = $pdo->prepare("UPDATE engines SET 
        model = ?, manufacturer = ?, location = ?, engine_type = ?, power_thrust = ?,
        year = ?, total_time_hours = ?, hr = ?, cycles = ?, `condition` = ?, price = ?,
        extra_details = ?, warranty = ?
    WHERE engine_id = ? AND vendor_id = ?");
    $update_query->execute([
        $model, $manufacturer, $location, $engine_type, $power_thrust,
        $year, $total_time_hours, $hr, $cycles, $condition, $price,
        $extra_details, $warranty, $engine_id, $vendor_id
    ]);

    // Handle image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $delete_images_query = $pdo->prepare("DELETE FROM product_images WHERE product_id = ? AND product_type = 'engine'");
        $delete_images_query->execute([$engine_id]);

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_name = basename($_FILES['images']['name'][$key]);
            $image_path = "uploads/" . uniqid() . "_" . $image_name;
            if (move_uploaded_file($tmp_name, $image_path)) {
                $insert_image_query = $pdo->prepare("INSERT INTO product_images (product_id, product_type, image_url) VALUES (?, 'engine', ?)");
                $insert_image_query->execute([$engine_id, $image_path]);
            }
        }
    }

    echo "<script>alert('Engine updated successfully!'); window.location.href = 'manage_products.php';</script>";
    exit();
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
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="font-weight-bold">Edit Engine</h3>
                <h6 class="font-weight-normal mb-0">Update your engine details here.</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Engine Information</h4>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="engine_id" value="<?= htmlspecialchars($engine['engine_id']); ?>">
                            
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" value="<?= htmlspecialchars($engine['model']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="manufacturer">Manufacturer</label>
                                <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?= htmlspecialchars($engine['manufacturer']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($engine['location']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="engine_type">Engine Type</label>
                                <input type="text" class="form-control" id="engine_type" name="engine_type" value="<?= htmlspecialchars($engine['engine_type']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="engine_type"> Cycles</label>
                                <input type="text" class="form-control" id="cycles" name="cycles" value="<?= htmlspecialchars($engine['cycles']); ?>" required>
                            </div>
                             <div class="form-group">
                                <label for="engine_type"> HR</label>
                                <input type="text" class="form-control" id="hr" name="hr" value="<?= htmlspecialchars($engine['hr']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="power_thrust">Power/Thrust</label>
                                <input type="text" class="form-control" id="power_thrust" name="power_thrust" value="<?= htmlspecialchars($engine['power_thrust']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" class="form-control" id="year" name="year" value="<?= htmlspecialchars($engine['year']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="total_time_hours">Total Time Hours</label>
                                <input type="number" class="form-control" id="total_time_hours" name="total_time_hours" value="<?= htmlspecialchars($engine['total_time_hours']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <input type="text" class="form-control" id="condition" name="condition" value="<?= htmlspecialchars($engine['condition']); ?>" required>
                            </div>
                             <div class="form-group">
                                <label for="condition">price</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($engine['price']); ?>" required>
                            </div>
                             <div class="form-group">
                                <label for="condition">Extra_details</label>
                                <input type="text" class="form-control" id="extra_details" name="extra_details" value="<?= htmlspecialchars($engine['extra_details']); ?>" required>
                            </div>
                             <div class="form-group">
                                <label for="condition">warranty</label>
                                <input type="text" class="form-control" id="warranty" name="warranty" value="<?= htmlspecialchars($engine['warranty']); ?>" required>
                            </div>
                            
           <div class="form-group">
    <label for="images">Engine Images</label>
    <input type="file" class="form-control" id="images" name="images[]" multiple>

    <?php
    $stmt = $pdo->prepare("SELECT image_id, image_url FROM product_images WHERE product_id = ? AND product_type = 'engine' ORDER BY sort_order ASC");
    $stmt->execute([$engine_id]);
    $images = $stmt->fetchAll();
    ?>

    <?php if (!empty($images)): ?>
        <div id="sortable-engine-images" class="photo-grid mt-4">
            <?php foreach ($images as $index => $img): ?>
                <div class="photo-item<?= $index === 0 ? ' main-photo' : '' ?>" data-id="<?= $img['image_id']; ?>">
                    <img src="<?= htmlspecialchars($img['image_url']); ?>" alt="Engine Image">
                    <?php if ($index === 0): ?>
                        <div class="main-label">Main</div>
                        <div class="photo-warning">Must be over 500 pixels wide</div>
                    <?php endif; ?>
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



                            <button type="submit" class="btn" style="background-color:#4747A1;color:white;">Update Engine</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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