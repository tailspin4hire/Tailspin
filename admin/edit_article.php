<?php
session_start();
require_once 'config.php';
require_once 'header.php';

// Get article ID from query parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Invalid article ID!'); window.location.href='articles_list.php';</script>";
    exit;
}

$id = $_GET['id'];

// Fetch existing article
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "<script>alert('Article not found!'); window.location.href='articles_list.php';</script>";
    exit;
}

// Handle update form submission
if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $content = $_POST['content'];
    $keywords = trim($_POST['tags']);
    $meta_description = trim($_POST['meta_description']);
    $publish_date = $_POST['publish_date'] ?? date('Y-m-d H:i:s');
    $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug));

    // Image upload
    $image_name = $article['image']; // Keep old image by default
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = 'image-nasa-' . time() . '.' . $ext;
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "uploads/" . $image_name);
    }

    // Update DB
    $updateStmt = $pdo->prepare("UPDATE articles SET title = ?, content = ?, image = ?, keywords = ?, meta_description = ?, slug = ?, publish_date = ? WHERE id = ?");
    $updateStmt->execute([$title, $content, $image_name, $keywords, $meta_description, $slug, $publish_date, $id]);

    echo "<script>alert('Article updated successfully!'); window.location.href='articles_list.php';</script>";
}
?>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- CKEditor 5 (Free) -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>


<!-- Frontend form: same as your add article form -->
<div class="container content-wrapper" style="margin:0px; max-width:1350px !important;"> 
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h4 class="mt-4">Edit Article</h4>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" class="form-control" required>
                </div>
                 <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" value="<?= htmlspecialchars($article['slug']) ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" id="editor" class="form-control" rows="5"><?= htmlspecialchars($article['content']) ?></textarea>
                </div>
                <div class="form-group">
                    <label>Upload Featured Image</label>
                    <?php if ($article['image']) : ?>
                        <div><img src="uploads/<?= $article['image'] ?>" width="130" class="mb-2"></div>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label>Publish Date</label>
                    <input type="datetime-local" name="publish_date" value="<?= date('Y-m-d\TH:i', strtotime($article['publish_date'])) ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tags">Tags (comma separated)</label>
                    <input type="text" name="tags" class="form-control" id="tags" value="<?= htmlspecialchars($article['keywords']) ?>">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description (SEO)</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="2"><?= htmlspecialchars($article['meta_description']) ?></textarea>
                </div>
                <button type="submit" name="submit" class="btn" style="color:white;background-color:#4747A1;">Update Article</button>
                <a href="articles_list.php" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor Script -->
<script>
    let editorInstance;
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
        });

    document.querySelector("form").addEventListener("submit", function (e) {
        const content = editorInstance.getData().trim();
        if (content === '') {
            alert("Please enter content before submitting.");
            e.preventDefault();
        }
    });
</script>




<?php require_once 'footer.php'; ?>
