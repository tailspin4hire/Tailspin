<?php
session_start();
require_once 'config.php'; // Database connection
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Collect form data safely
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $content = $_POST['content']; // Raw HTML from CKEditor
    $keywords = trim($_POST['tags']);
    $meta_description = trim($_POST['meta_description']);
    
    // Handle publish date
    $publish_date = !empty($_POST['publish_date']) ? date('Y-m-d H:i:s', strtotime($_POST['publish_date'])) : date('Y-m-d H:i:s');
    $created_at = date('Y-m-d H:i:s');

    // Generate a slug from the title
    $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug));
    $slug = preg_replace('/-+/', '-', $slug); // Clean double hyphens

    // Handle image upload
    $image_name = null;
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array(strtolower($ext), $allowed_exts)) {
            $image_name = 'image-nasa-' . time() . '.' . $ext;
            $image_tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($image_tmp, "uploads/" . $image_name);
        } else {
            echo "<script>alert('Invalid image format. Allowed: jpg, jpeg, png, gif, webp');</script>";
        }
    }

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO articles (title, content, image, keywords, meta_description, slug, publish_date, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $success = $stmt->execute([$title, $content, $image_name, $keywords, $meta_description, $slug, $publish_date, $created_at]);

    if ($success) {
        echo "<script>alert('Article added successfully!'); window.location.href='articles_list.php';</script>";
    } else {
        echo "<script>alert('Something went wrong while saving the article.');</script>";
    }
}
?>


<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- CKEditor 5 (Free) -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
            height:250px;
        }
    </style>
</head>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="font-weight-bold text-center">Add Article</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Content</label>
                                <textarea name="content" id="editor" class="form-control" rows="25" style="height:250px"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Upload Featured Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Publish Date</label>
                                <input type="datetime-local" name="publish_date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="tags">Tags (comma separated)</label>
                                <input type="text" name="tags" class="form-control" id="tags" placeholder="e.g. aviation, repair, news">
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description (SEO)</label>
                                <textarea name="meta_description" id="meta_description" class="form-control" rows="2"></textarea>
                            </div>

                            <button type="submit" name="submit" class="btn" style="background-color:#4747A1;color:white;">Add Article</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
