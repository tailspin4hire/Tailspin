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
$part_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch part details
$query = $pdo->prepare("SELECT * FROM parts WHERE part_id = ? AND vendor_id = ?");
$query->execute([$part_id, $vendor_id]);
$part = $query->fetch(PDO::FETCH_ASSOC);

if (!$part) {
    echo "<script>alert('Part not found or you do not have permission to edit it.'); window.location.href = 'part_list.php';</script>";
    exit();
}

// Fetch part images
$image_query = $pdo->prepare("SELECT image_url FROM product_images WHERE product_id = ? AND product_type = 'part'");
$image_query->execute([$part_id]);
$images = $image_query->fetchAll(PDO::FETCH_COLUMN, 0);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $part_number = $_POST['part_number'];
    $part_name = $_POST['part_name'];
    $condition = $_POST['condition'];
    $region = $_POST['region'];
    $price = $_POST['price'];
    $tagged_with_easa_form_1 = $_POST['tagged_with_easa_form_1'];
    $extra_details = $_POST['extra_details'];
    $warranty = $_POST['warranty'];
   

    // Update part details
    $update_query = $pdo->prepare("UPDATE parts SET 
            part_number = ?, part_name = ?, `condition` = ?, region = ?, price = ?, 
            tagged_with_easa_form_1 = ?, extra_details = ?, warranty = ?
        WHERE part_id = ? AND vendor_id = ?");
    $update_query->execute([
        $part_number, $part_name, $condition, $region, $price,
        $tagged_with_easa_form_1, $extra_details, $warranty, 
        $part_id, $vendor_id
    ]);

    // Handle image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $delete_images_query = $pdo->prepare("DELETE FROM product_images WHERE product_id = ? AND product_type = 'part'");
        $delete_images_query->execute([$part_id]);

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_name = basename($_FILES['images']['name'][$key]);
            $image_path = "uploads/" . uniqid() . "_" . $image_name;
            if (move_uploaded_file($tmp_name, $image_path)) {
                $insert_image_query = $pdo->prepare("INSERT INTO product_images (product_id, product_type, image_url) VALUES (?, 'part', ?)");
                $insert_image_query->execute([$part_id, $image_path]);
            }
        }
    }

    echo "<script>alert('Part updated successfully!'); window.location.href = 'manage_products.php';</script>";
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
                <h3 class="font-weight-bold">Edit Part</h3>
                <h6 class="font-weight-normal mb-0">Update your part details here.</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Part Information</h4>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="part_id" value="<?= htmlspecialchars($part['part_id']); ?>">
                            
                            <div class="form-group">
                                <label for="part_number">Part Number</label>
                                <input type="text" class="form-control" id="part_number" name="part_number" value="<?= htmlspecialchars($part['part_number']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="type">Part Name</label>
                                <input type="text" class="form-control" id="type" name="part_name" value="<?= htmlspecialchars($part['part_name']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <input type="text" class="form-control" id="condition" name="condition" value="<?= htmlspecialchars($part['condition']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="region">Region</label>
                                <input type="text" class="form-control" id="region" name="region" value="<?= htmlspecialchars($part['region']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($part['price']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tagged_with_easa_form_1">Tagged with EASA Form 1</label>
                                <select class="form-control" id="tagged_with_easa_form_1" name="tagged_with_easa_form_1">
                                    <option value="Yes" <?= $part['tagged_with_easa_form_1'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                                    <option value="No" <?= $part['tagged_with_easa_form_1'] == 'No' ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="extra_details">Extra Details</label>
                                <textarea class="form-control" id="extra_details" name="extra_details" required><?= htmlspecialchars($part['extra_details']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="warranty">Warranty</label>
                                <input type="text" class="form-control" id="warranty" name="warranty" value="<?= htmlspecialchars($part['warranty']); ?>" required>
                            </div>


                           <div class="form-group">
    <label for="images">Part Images</label>
    <input type="file" class="form-control" id="images" name="images[]" multiple>

    <?php
    // Fetch part images from database
    $stmt = $pdo->prepare("SELECT image_id, image_url FROM product_images WHERE product_id = ? AND product_type = 'part' ORDER BY sort_order ASC");
    $stmt->execute([$part_id]); // Make sure $part_id is defined
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if (!empty($images)): ?>
        <div id="sortable-part-images" class="photo-grid mt-4">
            <?php foreach ($images as $index => $img): ?>
                <div class="photo-item<?= $index === 0 ? ' main-photo' : '' ?>" data-id="<?= $img['image_id']; ?>">
                    <img src="<?= htmlspecialchars($img['image_url']); ?>" alt="Part Image" style="max-width: 100%; height: auto;">
                    <?php if ($index === 0): ?>
                        <div class="main-label">Main</div>
                        <div class="photo-warning">Must be over 500 pixels wide</div>
                    <?php endif; ?>
                    <a href="delete_image.php?id=<?= $img['image_id']; ?>&part_id=<?= $part_id ?>" class="btn btn-sm btn-danger mt-1">Delete</a>
                </div>
            <?php endforeach; ?>

            <div class="photo-item add-photo">
                <label for="add-part-photo">
                    <span>&#128247;</span><br>Add
                </label>
                <input type="file" name="images[]" id="add-part-photo" style="display: none;" multiple>
            </div>
        </div>

        <button type="button" class="btn btn-success mt-3" onclick="savePartImageOrder()">Save Image Order</button>
    <?php else: ?>
        <p>No images uploaded.</p>
    <?php endif; ?>
</div>


                            <button type="submit" class="btn btn-primary">Update Part</button>
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
    const grid = document.getElementById('sortable-part-images');

    if (grid) {
        new Sortable(grid, {
            animation: 150,
            filter: '.add-photo',
            draggable: '.photo-item:not(.add-photo)',
            onEnd: function () {
                updatePartMainLabel();
            }
        });

        updatePartMainLabel();
    }
});

// Get sorted image IDs
function getPartSortedIds() {
    return [...document.querySelectorAll('#sortable-part-images .photo-item:not(.add-photo)')]
        .map(item => item.dataset.id);
}

// Save order to server
function savePartImageOrder() {
    const ids = getPartSortedIds();

    if (ids.length === 0) {
        alert("No part images to sort.");
        return;
    }

    fetch('save_parts_image_order.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ order: ids, type: 'part' })
    })
    .then(response => response.text())
    .then(result => alert(result))
    .catch(error => {
        console.error(error);
        alert('Error saving part image order.');
    });
}

// Update Main label
function updatePartMainLabel() {
    const items = document.querySelectorAll('#sortable-part-images .photo-item:not(.add-photo)');

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
