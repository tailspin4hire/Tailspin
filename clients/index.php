<?php 
include "header.php";
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['vendor_id'])) {
    header("Location: ../login.php");
    exit;
}

include "config.php";
$vendor_id = $_SESSION['vendor_id'];

$username = $_SESSION['username'] ?? 'Client'; // Prevent undefined array key error

// Initialize variables
$total_sales = 0;
$total_revenue = 0;
$pending_orders = 0;
$approved_products = 0;
$rejected_products = 0;
$escrow_balance = 0;
$withdrawal_requests = 0;
$notifications = [];

// Fetch Total Sales and Revenue
$sales_query = $pdo->prepare("SELECT COUNT(DISTINCT order_id) AS total_sales, SUM(total_amount) AS total_revenue FROM orders WHERE order_id IN (SELECT order_id FROM order_items WHERE product_id IN (SELECT part_id FROM parts WHERE vendor_id = ?))");
$sales_query->execute([$vendor_id]);
$sales_data = $sales_query->fetch(PDO::FETCH_ASSOC);
$total_sales = $sales_data['total_sales'] ?? 0;
$total_revenue = $sales_data['total_revenue'] ?? 0;

// Fetch Pending Orders
$pending_orders_query = $pdo->prepare("SELECT COUNT(order_id) AS pending_orders FROM orders WHERE status = 'pending' AND order_id IN (SELECT order_id FROM order_items WHERE product_id IN (SELECT part_id FROM parts WHERE vendor_id = ?))");
$pending_orders_query->execute([$vendor_id]);
$pending_orders = $pending_orders_query->fetchColumn() ?? 0;

// Check if approval_status exists in parts
$table_check = $pdo->query("SHOW COLUMNS FROM parts LIKE 'approval_status'");
if ($table_check->rowCount() > 0) {
    $product_status_query = $pdo->prepare("SELECT SUM(CASE WHEN approval_status = 'approved' THEN 1 ELSE 0 END) AS approved_products, SUM(CASE WHEN approval_status = 'rejected' THEN 1 ELSE 0 END) AS rejected_products FROM parts WHERE vendor_id = ?");
    $product_status_query->execute([$vendor_id]);
    $product_status_data = $product_status_query->fetch(PDO::FETCH_ASSOC);
    $approved_products = $product_status_data['approved_products'] ?? 0;
    $rejected_products = $product_status_data['rejected_products'] ?? 0;
}

// Fetch Notifications
$notification_query = $pdo->prepare("SELECT message FROM notifications WHERE vendor_id = ? ORDER BY created_at DESC LIMIT 5");
$notification_query->execute([$vendor_id]);
$notifications = $notification_query->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
    <style>
        .card {
            background-color: white !important;
        }
                .card p, .card-title{
                    color:black !important;
                }
               .row a:hover{
                   text-decoration:none;
                   
               }
               .pages-links a{
                  background-color: #4747a1 !important;
                  color:white !important;
               }
                              .pages-links a:hover{
                                  background-color: lightgray !important;
                                  color:black !important;
                                  border:1px solid black !important;
                              }
    </style>
</head>
<div class="main-panel">
  <div class="content-wrapper">
  <div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-6 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Welcome, <?= htmlspecialchars($username); ?></h3>
        <h6 class="font-weight-normal mb-0">
          Here's your store's performance summary. You have 
          <span class="text-primary"><?= count($notifications); ?> unread notifications!</span>
        </h6>
      </div>
      <!-- Right side content with buttons in one row -->
      <div class="col-12 col-xl-6 pages-links">
        <div class="d-flex justify-content-end flex-wrap">
          <a href="addaircraft.php" class="btn btn-primary mb-2">List An Aircraft</a>
          <a href="manage_products.php" class="btn btn-primary mb-2">My Listings</a>
        </div>
      </div>
    </div>
  </div>
</div>


    <div class="row">
      <div class="col-md-3 grid-margin ">
    <a href="sales_reports.php">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">Total Sales</p>
            <p class="fs-30 mb-2"><?= htmlspecialchars($total_sales); ?></p>
            <p>15% increase (last 30 days)</p>
          </div>
        </div>
    </a>
      </div>
      <div class="col-md-3 grid-margin ">
           <a href="sales_reports.php">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">Total Revenue</p>
            <p class="fs-30 mb-2">$<?= number_format($total_revenue, 2); ?></p>
            <p>10% increase (last 30 days)</p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-md-3 grid-margin ">
           <a href="orders-management.php">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Pending Orders</p>
            <p class="fs-30 mb-2"><?= htmlspecialchars($pending_orders); ?></p>
            <p>5 new orders</p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-md-3 grid-margin ">
           <a href="manage_products.php">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">Products Status</p>
            <p class="fs-30 mb-2">Approved: <?= htmlspecialchars($approved_products); ?></p>
            <p>Rejected: <?= htmlspecialchars($rejected_products); ?></p>
          </div>
        </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Notifications</h4>
            <ul class="list-group">
              <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                  <li class="list-group-item"> <?= htmlspecialchars($notification['message']); ?> </li>
                <?php endforeach; ?>
              <?php else: ?>
                <li class="list-group-item">No notifications found.</li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
