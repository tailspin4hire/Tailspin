<?php
ob_start();
include "header.php";
include "config.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Check if part_id is set
if (!isset($_GET['part_id'])) {
    header("Location: admin-parts.php");
    exit;
}

$part_id = $_GET['part_id'];

// Fetch part details
$stmt = $pdo->prepare("SELECT * FROM parts WHERE part_id = ?");
$stmt->execute([$part_id]);
$part = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$part) {
    echo "<p>Part not found.</p>";
    exit;
}

// Fetch existing images
$image_stmt = $pdo->prepare("
    SELECT image_id, image_url 
    FROM product_images 
    WHERE product_id = ? AND product_type = 'part' 
    ORDER BY sort_order ASC
");
$image_stmt->execute([$part_id]);
$images = $image_stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $part_number = $_POST['part_number'];
    $condition = $_POST['condition'];
    $region = $_POST['region'];
    $price = $_POST['price'];
    $tagged_with_easa_form_1 = $_POST['tagged_with_easa_form_1'];
    $extra_details = $_POST['extra_details'];
    $warranty = $_POST['warranty'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("
        UPDATE parts 
        SET part_number = ?, `condition` = ?, region = ?, price = ?, 
            tagged_with_easa_form_1 = ?, extra_details = ?, warranty = ?, status = ? 
        WHERE part_id = ?
    ");

    if ($stmt->execute([
        $part_number, $condition, $region, $price,
        $tagged_with_easa_form_1, $extra_details, $warranty, $status, $part_id
    ])) {
        // ✅ Handle image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = "../vendors/uploads/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $fileName = time() . "_" . basename($_FILES['images']['name'][$key]);
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($tmp_name, $filePath)) {
                    $stmt = $pdo->prepare("
                        INSERT INTO product_images (product_id, product_type, image_url, created_at) 
                        VALUES (?, 'part', ?, NOW())
                    ");
                    $stmt->execute([$part_id, $filePath]);
                }
            }
        }

        header("Location: parts-listing.php?vendor_id=" . $part['vendor_id']);
        exit;
    } else {
        $error = "Failed to update part.";
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
        <h3>Edit Part</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Part Number</label>
                <input type="text" class="form-control" name="part_number" value="<?= htmlspecialchars($part['part_number']); ?>" required>
            </div>

            <div class="form-group">
                <label>Condition</label>
                <input type="text" class="form-control" name="condition" value="<?= htmlspecialchars($part['condition']); ?>" required>
            </div>

            <div class="form-group">
                <label>Region</label>
                <input type="text" class="form-control" name="region" value="<?= htmlspecialchars($part['region']); ?>" required>
            </div>

            <div class="form-group">
                <label>Price ($)</label>
                <input type="text" class="form-control" name="price" value="<?= htmlspecialchars($part['price']); ?>" required>
            </div>

            <div class="form-group">
                <label>Tagged with EASA Form 1</label>
                <select class="form-control" name="tagged_with_easa_form_1">
                    <option value="1" <?= $part['tagged_with_easa_form_1'] == '1' ? 'selected' : ''; ?>>Yes</option>
                    <option value="0" <?= $part['tagged_with_easa_form_1'] == '0' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>

            <div class="form-group">
                <label>Extra Details</label>
                <textarea class="form-control" name="extra_details"><?= htmlspecialchars($part['extra_details']); ?></textarea>
            </div>

            <div class="form-group">
                <label>Warranty</label>
                <textarea class="form-control" name="warranty"><?= htmlspecialchars($part['warranty']); ?></textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="pending" <?= $part['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="approved" <?= $part['status'] == 'approved' ? 'selected' : ''; ?>>Approved</option>
                    <option value="rejected" <?= $part['status'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </div>
<div class="form-group">
    <label for="images">Part Images</label>
    <input type="file" class="form-control" id="images" name="images[]" multiple>

    <?php if (!empty($images)): ?>
        <div id="sortable-part-images" class="photo-grid mt-4">
            <?php foreach ($images as $index => $img): ?>
                <div class="photo-item<?= $index === 0 ? ' main-photo' : '' ?>" data-id="<?= $img['image_id']; ?>">
                    <img src="../vendors/<?= htmlspecialchars($img['image_url']); ?>" alt="Part Image" style="max-width: 100%; height: auto;">
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
            <a href="parts-listing.php?vendor_id=<?= $part['vendor_id']; ?>" class="btn btn-secondary">Cancel</a>
        </form>
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
