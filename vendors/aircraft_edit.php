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

$vendor_id = $_SESSION['vendor_id']; // Corrected session variable
$aircraft_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Get aircraft ID from URL

// Fetch aircraft details
$query = $pdo->prepare("SELECT * FROM aircrafts 
    WHERE aircraft_id = ? AND vendor_id = ?");
$query->execute([$aircraft_id, $vendor_id]);
$aircraft = $query->fetch(PDO::FETCH_ASSOC);

if (!$aircraft) {
    echo "<script>alert('Aircraft not found or you do not have permission to edit it.'); window.location.href = 'aircraft_list.php';</script>";
    exit();
}

// Fetch aircraft images
$image_query = $pdo->prepare("SELECT image_url FROM product_images WHERE product_id = ? AND product_type = 'aircraft'");
$image_query->execute([$aircraft_id]);
$images = $image_query->fetchAll(PDO::FETCH_COLUMN, 0);
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aircraft_id = $_POST['aircraft_id'];
    $model = $_POST['model'];
    $location = $_POST['location'];
    $aircraft_type = $_POST['aircraft_type'];
    $manufacturer = $_POST['manufacturer'];
    $registration_number = $_POST['registration_number'];
    $serial_number = $_POST['serial_number'];
    $total_time_hours = $_POST['total_time_hours'];
    $year = $_POST['year'];
    $price = $_POST['price'];
     $price_label = $_POST['price_label'];
    $description = $_POST['description'];
    $features = $_POST['features'];
    $warranty = $_POST['warranty'];
    $vendor_id = $_SESSION['vendor_id'];

    // New fields
    $engine1_status = $_POST['engine1_status'] ?? null;
    $engine1_hours = $_POST['engine1_hours'] ?? null;
    $engine2_status = $_POST['engine2_status'] ?? null;
    $engine2_hours = $_POST['engine2_hours'] ?? null;
    $prop1_status = $_POST['prop1_status'] ?? null;
    $prop1_hours = $_POST['prop1_hours'] ?? null;
    $prop2_status = $_POST['prop2_status'] ?? null;
    $prop2_hours = $_POST['prop2_hours'] ?? null;

    // Update aircraft record with new fields
    $update_query = $pdo->prepare("UPDATE aircrafts SET 
        model = ?, location = ?, aircraft_type = ?, manufacturer = ?, 
        registration_number = ?, serial_number = ?, year = ?, price = ?, price_label=?,
        description = ?, features = ?, warranty = ?,
        engine1_status = ?, engine1_hours = ?, engine2_status = ?, engine2_hours = ?,
        prop1_status = ?, prop1_hours = ?, prop2_status = ?, prop2_hours = ?, total_time_hours=?
        WHERE aircraft_id = ? AND vendor_id = ?");

    $update_query->execute([
        $model, $location, $aircraft_type, $manufacturer,
        $registration_number, $serial_number, $year, $price,$price_label,
        $description, $features, $warranty,
        $engine1_status, $engine1_hours, $engine2_status, $engine2_hours,
        $prop1_status, $prop1_hours, $prop2_status, $prop2_hours,$total_time_hours,
        $aircraft_id, $vendor_id
    ]);

    // Handle image uploads
    if (!empty($_FILES['images']['name'][0])) {
        // Delete old images
        $delete_images_query = $pdo->prepare("DELETE FROM product_images WHERE product_id = ? AND product_type = 'aircraft'");
        $delete_images_query->execute([$aircraft_id]);

        // Upload new images
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_name = basename($_FILES['images']['name'][$key]);
            $image_path = "uploads/" . uniqid() . "_" . $image_name;
            if (move_uploaded_file($tmp_name, $image_path)) {
                $insert_image_query = $pdo->prepare("INSERT INTO product_images (product_id, product_type, image_url) VALUES (?, 'aircraft', ?)");
                $insert_image_query->execute([$aircraft_id, $image_path]);
            }
        }
    }

    echo "<script>alert('Aircraft updated successfully!'); window.location.href = 'manage_products.php';</script>";
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
                <h3 class="font-weight-bold">Edit Aircraft</h3>
                <h6 class="font-weight-normal mb-0">
                    Update your aircraft details here.
                </h6>
            </div>
        </div>

        <!-- Aircraft Form -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Aircraft Information</h4>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <!-- Hidden Fields -->
                            <input type="hidden" name="aircraft_id" value="<?= htmlspecialchars($aircraft['aircraft_id']); ?>">

                            <!-- Model -->
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model" value="<?= htmlspecialchars($aircraft['model'] ?? ''); ?>" required>
                            </div>

                            <!-- Location -->
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($aircraft['location'] ?? ''); ?>" required>
                            </div>

                            <!-- Aircraft Type -->
                            <div class="form-group">
                                <label for="aircraft_type">Aircraft Type</label>
                                <input type="text" class="form-control" id="aircraft_type" name="aircraft_type" value="<?= htmlspecialchars($aircraft['aircraft_type'] ?? ''); ?>" required>
                            </div>

                            <!-- Manufacturer -->
                            <div class="form-group">
                                <label for="manufacturer">Manufacturer</label>
                                <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?= htmlspecialchars($aircraft['manufacturer'] ?? ''); ?>" required>
                            </div>

                           <div class="form-group">
                                <label for="total_time_hours">Total Time</label>
                                <input type="number" class="form-control" id="total_time_hours" name="total_time_hours" value="<?= htmlspecialchars($aircraft['total_time_hours'] ?? ''); ?>" required>
                            </div>
                            <!-- Condition -->
                            <div class="form-group">
                                <label for="registration_number">Registration Number</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?= htmlspecialchars($aircraft['registration_number'] ?? ''); ?>" required>
                            </div>

  <!-- Total Time Hours -->
                            <div class="form-group">
                                <label for="serial_number">Serial Number</label>
                                <input type="text" class="form-control" id="serial_number" name="serial_number" value="<?= htmlspecialchars($aircraft['serial_number'] ?? ''); ?>" required>
                            </div>

                         <!-- Engine and Propeller Details -->
<div class="form-group">
    <label for="engine1_status">Engine 1 Status</label>
    <input type="text" class="form-control" id="engine1_status" name="engine1_status" value="<?= htmlspecialchars($aircraft['engine1_status'] ?? ''); ?>">
</div>

<div class="form-group">
    <label for="engine1_hours">Engine 1 Hours</label>
    <input type="number" class="form-control" id="engine1_hours" name="engine1_hours" value="<?= htmlspecialchars($aircraft['engine1_hours'] ?? ''); ?>">
</div>

<div class="form-group">
    <label for="engine2_status">Engine 2 Status</label>
    <input type="text" class="form-control" id="engine2_status" name="engine2_status" value="<?= htmlspecialchars($aircraft['engine2_status'] ?? ''); ?>">
</div>

<div class="form-group">
    <label for="engine2_hours">Engine 2 Hours</label>
    <input type="number" class="form-control" id="engine2_hours" name="engine2_hours" value="<?= htmlspecialchars($aircraft['engine2_hours'] ?? ''); ?>">
</div>

<div class="form-group">
    <label for="prop1_status">Propeller 1 Status</label>
    <input type="text" class="form-control" id="prop1_status" name="prop1_status" value="<?= htmlspecialchars($aircraft['prop1_status'] ?? ''); ?>">
</div>

<div class="form-group">
    <label for="prop1_hours">Propeller 1 Hours</label>
    <input type="number" class="form-control" id="prop1_hours" name="prop1_hours" value="<?= htmlspecialchars($aircraft['prop1_hours'] ?? ''); ?>">
</div>

<div class="form-group">
    <label for="prop2_status">Propeller 2 Status</label>
    <input type="text" class="form-control" id="prop2_status" name="prop2_status" value="<?= htmlspecialchars($aircraft['prop2_status'] ?? ''); ?>">
</div>

<div class="form-group">
    <label for="prop2_hours">Propeller 2 Hours</label>
    <input type="number" class="form-control" id="prop2_hours" name="prop2_hours" value="<?= htmlspecialchars($aircraft['prop2_hours'] ?? ''); ?>">
</div>

                            <!-- Year -->
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" class="form-control" id="year" name="year" value="<?= htmlspecialchars($aircraft['year'] ?? ''); ?>" required>
                            </div>

                          
   <div class="form-group">
    <label>Price Label (Optional)</label>
    <select class="form-control" name="price_label">
        <option value="">-- Select --</option>
         <option value="sp" <?= $aircraft['price_label'] == 'sp' ? 'selected' : ''; ?>>Sales Price</option>
        <option value="call" <?= $aircraft['price_label'] == 'call' ? 'selected' : ''; ?>>Call for Price</option>
        <option value="obo" <?= $aircraft['price_label'] == 'obo' ? 'selected' : ''; ?>>OBO</option>
        <option value="starting_bid" <?= $aircraft['price_label'] == 'starting_bid' ? 'selected' : ''; ?>>Starting Bid</option>
    </select>
</div>

                            <!-- Price -->
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" id="price" value="<?= htmlspecialchars($aircraft['price'] ?? ''); ?>" required>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($aircraft['description'] ?? ''); ?></textarea>
                            </div>

                            <!-- Features -->
                            <div class="form-group">
                                <label for="features">Features</label>
                                <textarea class="form-control" id="features" name="features" rows="4"><?= htmlspecialchars($aircraft['features'] ?? ''); ?></textarea>
                            </div>

                            <!-- Warranty -->
                            <div class="form-group">
                                <label for="warranty">Warranty</label>
                                <input type="text" class="form-control" id="warranty" name="warranty" value="<?= htmlspecialchars($aircraft['warranty'] ?? ''); ?>">
                            </div>

                            <!-- Images -->
                         <div class="form-group">
    <label>Aircraft Images</label>
    <input type="file" class="form-control" name="images[]" multiple>

    <?php
    $stmt = $pdo->prepare("SELECT image_id, image_url FROM product_images WHERE product_id = ? AND product_type = 'aircraft' ORDER BY sort_order ASC");
    $stmt->execute([$aircraft_id]);
    $images = $stmt->fetchAll();
    ?>

    <?php if (!empty($images)): ?>
        <div id="sortable-images" class="photo-grid mt-4">
            <?php foreach ($images as $index => $img): ?>
                <div class="photo-item<?= $index === 0 ? ' main-photo' : '' ?>" data-id="<?= $img['image_id']; ?>">
                    <img src="<?= htmlspecialchars($img['image_url']); ?>" alt="Aircraft Image">
                    <?php if ($index === 0): ?>
                        <div class="main-label">Main</div>
                        <div class="photo-warning">Must be over 500 pixels wide</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <!-- Add new image slot -->
            <div class="photo-item add-photo">
                <label for="add-photo">
                    <span>&#128247;</span><br>Add
                </label>
                <input type="file" name="images[]" id="add-photo" style="display: none;" multiple>
            </div>
        </div>

        <button type="button" class="btn btn-success mt-3" onclick="saveImageOrder()">Save Image Order</button>
    <?php else: ?>
        <p>No images uploaded.</p>
    <?php endif; ?>
</div>



                            <button type="submit" class="btn btn-primary">Update Aircraft</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<script>-->
<!--  document.getElementById('price').addEventListener('input', function (e) {-->
<!--    let value = e.target.value.replace(/,/g, '');-->
<!--    if (!isNaN(value) && value !== '') {-->
<!--      e.target.value = parseInt(value).toLocaleString('en-US');-->
<!--    } else {-->
<!--      e.target.value = '';-->
<!--    }-->
<!--  });-->
<!--</script>-->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const priceLabel = document.getElementById('price_label');
    const priceInput = document.getElementById('price');

    function togglePriceInput() {
      if (priceLabel.value === 'call') {
        priceInput.disabled = true;
        priceInput.value = ''; // Optional: clear input when disabled
      } else {
        priceInput.disabled = false;
      }
    }

    // Run once on page load
    togglePriceInput();

    // Listen for dropdown change
    priceLabel.addEventListener('change', togglePriceInput);
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = document.getElementById('sortable-images');

    new Sortable(grid, {
        animation: 150,
        filter: '.add-photo', // prevent the "Add" slot from being dragged
        draggable: '.photo-item:not(.add-photo)',
        onEnd: function () {
            updateMainLabel(); // update which image is marked "Main"
        }
    });

    updateMainLabel(); // initialize on load
});

// Get the reordered image IDs
function getSortedIds() {
    return [...document.querySelectorAll('#sortable-images .photo-item:not(.add-photo)')]
        .map(item => item.dataset.id);
}

// Save order to server
function saveImageOrder() {
    const ids = getSortedIds();

    if (ids.length === 0) {
        alert("No images to sort.");
        return;
    }

    fetch('save_image_order.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({order: ids})
    })
    .then(response => response.text())
    .then(result => alert(result))
    .catch(error => {
        console.error(error);
        alert('Error saving image order.');
    });
}

// Update the "Main" label and warning
function updateMainLabel() {
    const items = document.querySelectorAll('#sortable-images .photo-item:not(.add-photo)');
    
    items.forEach((item, index) => {
        // Clear existing labels/warnings
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