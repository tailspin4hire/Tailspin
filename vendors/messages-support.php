<?php
session_start();
include "header.php";
include "config.php"; // Database connection

// Ensure vendor is logged in
if (!isset($_SESSION['vendor_id'])) {
   header("Location: ../login.php");
    exit;
}

$vendor_id = $_SESSION['vendor_id'];

// Fetch support messages
$query = $pdo->prepare("
    SELECT message_id, message, sender, status, created_at
    FROM support_messages
    WHERE vendor_id = ?
    ORDER BY created_at DESC
");
$query->execute([$vendor_id]);
$messages = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main-panel">
  <div class="content-wrapper">
    <!--<h3 class="font-weight-bold">Support Messages</h3>-->
    <!--<h6 class="font-weight-normal mb-4">Send messages to support and track responses.</h6>-->
     <div class="row mb-5">
      <div class="col-12 col-xl-5 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Support Messages</h3>
        <h6 class="font-weight-normal mb-0">
      Send messages to support and track responses.
        </h6>
      </div>
      <!-- Right side content with buttons in one row -->
      <div class="col-12 col-xl-7 pages-links">
        <div class="d-flex justify-content-between flex-wrap">
          <a href="addaircraft.php" class="btn  mb-2" style="background-color:#4747A1;color:white;" >List An Aircraft</a>
           <a href="addparts.php" class="btn  mb-2" style="background-color:#4747A1;color:white;">List A Part</a>
          <a href="addengines.php" class="btn  mb-2" style="background-color:#4747A1;color:white;">List An Engine</a>
         
          <a href="add_services.php" class="btn  mb-2" style="background-color:#4747A1;color:white;">List A Service</a>
          <a href="manage_products.php" class="btn  mb-2" style="background-color:#4747A1;color:white;">My Listings</a>
        </div>
      </div>
    </div>

    <!-- Send Message Form -->
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Send a New Message</h4>
        <form method="POST" action="send_message.php">
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Describe your issue" required></textarea>
          </div>
          <button type="submit" class="btn" style="background-color:#4747A1;color:white;">Send Message</button>
        </form>
      </div>
    </div>

    <!-- Messages Table -->
    <div class="card mt-4">
      <div class="card-body">
        <h4 class="card-title">Your Messages</h4>
        <table class="table">
          <thead>
            <tr>
              <th>Message</th>
              <th>Sender</th>
              <th>Status</th>
              <th>Sent At</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($messages) > 0): ?>
              <?php foreach ($messages as $message): ?>
                <tr>
                  <td><?= htmlspecialchars($message['message']); ?></td>
                  <td>
                    <?= $message['sender'] === 'vendor' ? '<span class="text-primary">You</span>' : '<span class="text-success">Support</span>'; ?>
                  </td>
                  <td>
                    <span class="<?= $message['status'] === 'read' ? 'text-success' : 'text-warning'; ?>">
                      <?= ucfirst($message['status']); ?>
                    </span>
                  </td>
                  <td><?= htmlspecialchars($message['created_at']); ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center">No messages found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php include "footer.php"; ?>
