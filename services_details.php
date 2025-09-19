<?php
include 'config.php';

// Get service ID from query string
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch service details
$stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
$stmt->execute([$serviceId]);
$service = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$service) {
    echo "<p>Service not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($aircraft['manufacturer'] . ' ' . $aircraft['model']) ?> | Aircraft Details - Flying411</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="description" content="<?= htmlspecialchars(substr(strip_tags($aircraft['description']), 0, 160)) ?>">
<meta name="keywords" content="aircraft for sale, <?= htmlspecialchars($aircraft['manufacturer']) ?>, <?= htmlspecialchars($aircraft['model']) ?>, <?= htmlspecialchars($aircraft['category']) ?> aircraft, aircraft <?= htmlspecialchars($aircraft['condition']) ?>, <?= htmlspecialchars($aircraft['location']) ?>">
<meta name="author" content="Flying411">

<!-- Open Graph / Facebook -->
<meta property="og:site_name" content="Flying411">
<meta property="og:title" content="<?= htmlspecialchars($aircraft['manufacturer'] . ' ' . $aircraft['model']) ?> - Aircraft for Sale">
<meta property="og:description" content="<?= htmlspecialchars(substr(strip_tags($aircraft['description']), 0, 160)) ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="<?= !empty($images[0]) ? htmlspecialchars($images[0]) : 'https://flying411.com/assets/images/default-aircraft.jpg' ?>">
<meta property="og:url" content="https://flying411.com/aircraft-details.php?id=<?= $aircraft_id ?>">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($aircraft['manufacturer'] . ' ' . $aircraft['model']) ?> - Aircraft for Sale">
<meta name="twitter:description" content="<?= htmlspecialchars(substr(strip_tags($aircraft['description']), 0, 160)) ?>">
<meta name="twitter:image" content="<?= !empty($images[0]) ? htmlspecialchars($images[0]) : 'https://flying411.com/assets/images/default-aircraft.jpg' ?>">

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-K9EWL5C594');
    </script>

 <!-- Apple Touch Icon (iPhones, iPads) -->
<link rel="apple-touch-icon" sizes="180x180" href="/assets/corporate/img/Hangar-2-4-White-Final-1.png">

<!-- Android / Chrome -->
<link rel="icon" type="image/png" sizes="192x192" href="/assets/corporate/img/Hangar-2-4-White-Final-1.png">
<link rel="icon" type="image/png" sizes="512x512" href="/assets/corporate/img/Hangar-2-4-White-Final-1.png">

<!-- Safari Pinned Tab (macOS) -->
<link rel="mask-icon" href="/assets/corporate/img/Hangar-2-4-White-Final-1.png" color="#5bbad5">

<!-- Web Manifest (optional for PWA support) -->
<link rel="manifest" href="/site.webmanifest">


  <!-- Fonts START -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="assets/pages/css/animate.css" rel="stylesheet">
  <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
  <!-- Page level plugin styles END -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="/assets/pages/css/animate.css" rel="stylesheet">
  <link href="/assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="/assets/plugins/owl.carousel//assets/owl.carousel.css" rel="stylesheet">
  <!-- Page level plugin styles END -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Theme styles START -->
  <link href="/assets/pages/css/components.css" rel="stylesheet">
  <link href="/assets/pages/css/slider.css" rel="stylesheet">
  <link href="/assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="/assets/corporate/css/style.css" rel="stylesheet">
  <link href="/assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="/assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="/assets/corporate/css/custom.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
 
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-K9EWL5C594"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-K9EWL5C594');
</script>
 <style>
*{
  margin: 0;
 
   font-family: "EB Garamond", serif; !important;
}
         .top-bars {
            display: flex;
            justify-content: space-between;
            /* padding: 10px 20px; */
            color: black;
            width:80%;
            font-size: 16px;
            margin:auto;

        }
        .top-bars a {
            color: black;
            text-decoration: none;
            font-size:16px;
        }
        .main {
            width:80%;
            margin: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            /* padding: 0px 20 ; */
        }
        .containers {
            width: 60%;
            /* background-color: #f4f4f4; */
            border-radius: 8px;
             padding: 20px; 
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }
        .sideheader {
            width:100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .sideheader h1 {
            margin: 0;
            font-size: 24px;
            color:black;
              font-family: "EB Garamond", serif; !important;
        }
        .sideheader .price {
            font-size: 24px;
            font-weight: bold;
            color: black;
        }
        .image-section {
            /* width:60%; */
            margin-top: 10px;
        }
        #main-image {
            width: 100%;
            height:400px !important;
            border-radius: 8px;
        }
        .thumbnail-row {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            margin: 10px auto;
            justify-content:center;
        }
        .thumbnail-row img {
            width: 100px;
            height: 80px;
            border-radius: 4px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .thumbnail-row img:hover {
            transform: scale(1.1);
        }
        .dropdown {
            margin-top: 20px;
        }
        .dropdown h3 {
            margin: 10px 0;
        }
        .sidebar {
            width: 35%;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
             /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
                         box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }
        .sidebar button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border:1px solid #666;
            background-color: white;
            color: black;
            cursor: pointer;
            border-radius: 8px !important;
            font-size: 20px;
            
        }
        .sidebar button:hover {
            background-color: lightgray;
            color:black;
            border: 1px solid black;

        }
        .sidebar .details-table {
            width: 100%;
            border-collapse: collapse;
            color:black;
        }
       
        .sidebar .details-table th,
        .sidebar .details-table td {
            border-bottom: 1px solid #ddd;
            padding: 18px  5px;
            letter-spacing: 1px;
            text-align: left;
            /*background-color: #e7e9eb;*/
        }
                .sidebar .details-table th{
                    font-weight: 500;
                }
.details-section {
  width: 100%;
  margin-top: 20px;
  font-size: 16px;
  color: #333;
}

.detail-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 10px;
  border-bottom: 1px solid #ddd;
}

.detail-row:last-child {
  border-bottom: none;
}

.detail-label {
  font-weight: bold;
  text-transform: uppercase;
}

.detail-value {
  font-size: 16px;
  color: #555;
}

.expandable {
  cursor: pointer;
}

.expand-icon {
  font-weight: bold;
  color: #888;
  font-size: 18px;
}
.header .mobi-toggler{
    margin:0px !important;
}

@media (max-width: 768px) {
    .top-bars {
        flex-direction: column;
        text-align: center;
    }
    .main {
        flex-direction: column;
        width: 100%;
        padding: 10px;
    }
    .containers, .sidebar {
        width: 100%;
        margin-bottom: 20px;
    }
    .sideheader h1, .sideheader .price {
        font-size: 20px;
    }
    .thumbnail-row img {
        width: 80px;
        height: 60px;
    }
    .sidebar button {
        font-size: 18px;
    }
    .details-section {
        font-size: 14px;
    }
    .detail-label {
        font-size: 14px;
    }
    .detail-value {
        font-size: 14px;
    }
    .ecommerce .header .mobi-toggler{
        margin:0px !important;
    }
}
/* Add custom styles to the chat window */
#chatWindow {
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

#chatMessages {
    padding: 10px;
    max-height: 280px;
    overflow-y: auto;
}

#chatInput {
    width: 100%;
    padding: 11px;
    border-radius: 5px;
}

button {
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
}

.sidebar .details-table tr:nth-child(odd) {
  background-color: #ffffff; /* White color for odd rows */
}

.sidebar .details-table tr:nth-child(even) {
  background-color: #e7e9eb; /* Light gray for even rows */
}
.image-section {
    position: relative;
}

.main-image-wrapper {
    position: relative;
}

#main-image {
    width: 100%;
    height: 400px;
    display: block;
}

.arrows {
    position: absolute;
    top: 50%;
    width: 100%;
    display: none;
    justify-content: space-between;
    transform: translateY(-50%);
}

.arrow-left, .arrow-right {
    background-color: black;
    color: #fff;
    font-size: 24px;
    padding: 10px;
    cursor: pointer;
    border-radius: 30px;
}

.thumbnail-row {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.thumbnail-row img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    cursor: pointer;
}

.image-section:hover .arrows {
    display: flex;
}
  /* Left Section (Table) */
        .left-section {
            flex: 1;
            /*min-width: 300px;*/
            /*background: #f9f9f9;*/
            /*padding: 20px;*/
            border-radius: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
        }

        /* Right Section (Description) */
        .right-section {
            flex: 1;
            min-width: 300px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .right-section h2 {
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }

     .left-section  .details-table {
            width: 100%;
            border-collapse: collapse;
            color:black;
        }
       
        .left-section  .details-table th ,td {
            border-bottom: 1px solid #ddd;
            padding: 17px;
            letter-spacing: 1px;
            text-align: left;
            /*background-color: #e7e9eb;*/
        }
         .left-section  .details-table th{
                    font-weight: 500;
                }
                
                .left-section .details-table tr:nth-child(odd) {
  background-color: #ffffff; /* White color for odd rows */
}

 .left-section .details-table tr:nth-child(even) {
  background-color: #e7e9eb; /* Light gray for even rows */
}
.popup-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.popup-content {
    background: #fff;
    padding: 20px;
    width: 70%;
    max-width: 800px;
    border-radius: 8px;
    position: relative;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 24px;
    cursor: pointer;
}
 .site-logo img{
        border-radius: 50% !important;
        margin-right: 110px !important;
    }
    .header .top-cart-block a:hover{
    background-color: white!important;
    color: black !important; 
    border: 1px solid black !important;
}
.header{
    margin-top:20px !important;
}
#document-list{
    display:none;
}
@media (max-width: 1200px) {
    .container, .container-lg, .container-md, .container-sm {
        max-width: 1020px !important;
    }
   
     .site-logo img{
        margin-right:0px !important;
   }
}
    </style>
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce">
  <!-- BEGIN TOP BAR -->

  <!-- END TOP BAR -->

  <!-- BEGIN HEADER -->
  <div class="header" >
    <div class="container headlogo" style="display: flex; justify-content: space-between; align-items: center; flex-direction:row;">
      <a class="site-logo" style="padding: 0px; margin:0px;" href="/"><img src="/assets/corporate/img/Hangar-2-4-White-Final-1.png" alt="Metronic Shop UI"></a>

      <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

      

      <!-- BEGIN NAVIGATION -->
       <div class="header-navigation">
        <ul>
             <li><a href="/">HOME</a></li>
    <li><a href="/parts">PARTS</a></li>
    <li><a href="/engine">ENGINES</a></li>
    <li><a href="/aircraft">AIRCRAFT</a></li>
        <li><a href="/services">Services</a></li>
    <li><a href="/contacts">CONTACT US</a></li>
       <li style="display:none;">
           <?php if (isset($_SESSION['user_id'])): ?>
    <!-- Show Dashboard link if user is logged in -->
    <a href="/client_dashboard" style="padding: 8px 20px; color: black; background-color:lightgray;font-weight: bold;font-size: 15px;border-radius: 5px !important; text-decoration: none;">Dashboard</a>
  <?php else: ?>
    <!-- Show Login button if user is not logged in -->
    <a href="/login" style="padding: 8px 20px; color: black; background-color:lightgray;font-weight: bold;font-size: 15px;border-radius: 5px !important; text-decoration: none;">LOGIN / REGISTER</a>
  <?php endif; ?></li>
    
  
          
          <!-- BEGIN TOP SEARCH -->
       
          <!-- END TOP SEARCH -->
        </ul>
      </div>
  
<div class="top-cart-block">
 <?php if (isset($_SESSION['user_id'])): ?>
    <!-- Show Dashboard link if user is logged in -->
    <a href="/client_dashboard" style="padding: 8px 20px; color: black; background-color:lightgray;font-weight: bold;font-size: 15px;border-radius: 5px !important; text-decoration: none;">Dashboard</a>
  <?php else: ?>
    <!-- Show Login button if user is not logged in -->
    <a href="/login" style="padding: 8px 20px; color: black; background-color:lightgray;font-weight: bold;font-size: 15px;border-radius: 5px !important; text-decoration: none;">LOGIN / REGISTER</a>
  <?php endif; ?>
</div>
      <!-- END NAVIGATION -->
       <!-- BEGIN CART -->
     
      <!--END CART -->
    </div>
  </div>
    <!-- Header END -->
    </div>

    <div class="top-bars" style="margin-top:50px; margin-bottom:20px;">
    <a href="javascript:void(0)" onclick="window.history.back()"> Back to Services</a>
    </div>

<div class="main">
    <div class="containers">
        <div class="sideheader">
            <h1 style="font-weight:100; font-size:20px;">
                <?= htmlspecialchars($service['business_name']) ?> - <?= htmlspecialchars($service['service_type']) ?>
            </h1>
            <?php
$rate = '';
if (!empty($service['hourly_rate'])) {
    $rate = '$' . htmlspecialchars($service['hourly_rate']) . ' / hour';
} elseif (!empty($service['instruction_rate'])) {
    $rate = '$' . htmlspecialchars($service['instruction_rate']) . ' / hour';
} elseif (!empty($service['ground_rate'])) {
    $rate = '$' . htmlspecialchars($service['ground_rate']) . ' / hour';
}
?>

<?php if ($rate): ?>
    <span class="price" style="font-weight:100; font-size:20px;">
        <?= $rate ?>
    </span>
<?php endif; ?>

        </div>

        <?php
$photoArray = json_decode($service['photos'], true);
$mainPhoto = isset($photoArray[0]) ? $photoArray[0] : 'default.jpg'; // fallback if empty
?>

<div class="image-section">
    <div class="main-image-wrapper">
        <img src="vendors/uploads/<?= htmlspecialchars($mainPhoto) ?>" alt="Service Image" id="main-image">
    </div>
</div>

    </div>

    <div class="sidebar">
        <table class="details-table">
            <?php if (!empty($service['business_name'])): ?>
            <tr><th>Shope Name</th><td><?= htmlspecialchars($service['business_name']) ?></td></tr>
            <?php endif; ?>

            <?php if (!empty($service['service_type'])): ?>
            <tr><th>Specialty</th><td><?= htmlspecialchars($service['service_type']) ?></td></tr>
            <?php endif; ?>
            <?php if (!empty($service['mechanic_ratings'])): ?>
            <tr><th>Mechanic Ratings</th><td><?= htmlspecialchars($service['mechanic_ratings']) ?></td></tr>
            <?php endif; ?>
            <?php if (!empty($service['instruction_offered'])): ?>
            <tr><th>Instruction Offered</th><td><?= htmlspecialchars($service['instruction_offered']) ?></td></tr>
            <?php endif; ?>
            
          <?php if (!empty($service['ratings'])): ?>
    <?php
        $certifications = json_decode($service['ratings'], true);
        if (is_array($certifications)) {
            $certList = implode(', ', array_map('htmlspecialchars', $certifications));
        } else {
            $certList = htmlspecialchars($service['ratings']);
        }
    ?>
    <tr><th>Certifications</th><td><?= $certList ?></td></tr>
<?php endif; ?>

 
            <?php if (!empty($service['country'])): ?>
            <tr><th>Location</th><td><?= htmlspecialchars($service['country']) ?></td></tr>
            <?php endif; ?>

            <?php if (!empty($service['instruction_offered'])): ?>
            <tr><th>Certifications</th><td><?= htmlspecialchars($service['instruction_offered']) ?></td></tr>
            <?php endif; ?>

            <?php if (!empty($service['website'])): ?>
            <tr><th>Website</th><td><a href="<?= htmlspecialchars($service['website']) ?>" target="_blank"><?= htmlspecialchars($service['website']) ?></a></td></tr>
            <?php endif; ?>

            <?php if (!empty($service['email'])): ?>
            <tr><th>Email</th><td><a href="mailto:<?= htmlspecialchars($service['email']) ?>"><?= htmlspecialchars($service['email']) ?></a></td></tr>
            <?php endif; ?>


            <?php if (!empty($service['phone_number'])): ?>
            <tr><th>Phone</th><td><a href="tel:<?= htmlspecialchars($service['phone_number']) ?>"><?= htmlspecialchars($service['phone_number']) ?></a></td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<div class="container" style="display: flex; flex-wrap: wrap; gap: 20px; padding: 35px 0px;">
    <div class="right-section">
        <h2 style="font-size:25px; font-weight:500;">Description</h2>
        <p><?= nl2br(htmlspecialchars($service['description'])) ?></p>
    </div>
</div>

   
  


    <!-- BEGIN PRE-FOOTER -->
    <div class="pre-footer">
      <div class="container">
      <div class="row">
        <!-- BEGIN BOTTOM ABOUT BLOCK -->
        <div class="col-md-3 col-sm-6 pre-footer-col">
          <h2>About us</h2>
          <p>Welcome to Flying411 your trusted platform for buying, selling, and exploring aircraft.
             With a passion for aviation and a commitment to excellence, we connect aircraft buyers and sellers from around the world. Whether you're looking to purchase a private jet, sell your aircraft, or explore aviation services, we provide a seamless and secure experience tailored to your needs.</p>
        </div>
        <!-- END BOTTOM ABOUT BLOCK -->
        <!-- BEGIN BOTTOM INFO BLOCK -->
        <div class="col-md-3 col-sm-6 pre-footer-col">
          <h2>Information</h2>
          <ul class="list-unstyled">
            <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Delivery Information</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Customer Service</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Order Tracking</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Shipping &amp; Returns</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="/contacts">Contact Us</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="/blogs">Articles</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Payment Methods</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 pre-footer-col">
          <h2>Our Contacts</h2>
          <address class="margin-bottom-40">
            Phone: +1 (904) 994-6224<br>
            Cory@Flying411.com<br>
            <a href="https://flying411.com/">Flying411.com</a>
          </address>
        </div>
        <!-- END BOTTOM CONTACTS -->
      </div>
      <hr>
    </div>
    </div>

    <!-- BEGIN fast view of a product -->
    <div id="product-pop-up" style="display: none; width: 700px;">
            <div class="product-page product-pop-up">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-3">
                  <div class="product-main-image">
                    <img src="/assets/pages/img/products/product1.jpg" alt="Cool green dress with red bell" class="img-responsive">
                  </div>
                  <div class="product-other-images">
                    <a href="javascript:;" class="active"><img alt="Berry Lace Dress" src="/assets/pages/img/products/product2.jpg"></a>
                    <a href="javascript:;"><img alt="Berry Lace Dress" src="/assets/pages/img/products/air1.jpg"></a>
                    <a href="javascript:;"><img alt="Berry Lace Dress" src="/assets/pages/img/products/air3.jpg"></a>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-9">
                  <h2>Lorem ipsum dolor sit amet.</h2>
                  <div class="price-availability-block clearfix">
                    <div class="price">
                      <strong><span>Aircraft</span>Details</strong>
                      
                    </div>
                  </div>
                  <div class="description">
                    <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat Nostrud duis molestie at dolore.</p>
                  </div>
                  <div class="product-page-cart">
                    <div class="product-quantity">
                        <input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
                    </div>
                    <button class="btn btn-primary" type="submit">Chat with Dealer</button>
                    <a href="#" class="btn btn-default">More details</a>
                  </div>
                </div>

                <div class="sticker sticker-sale"></div>
              </div>
            </div>
    </div>
   

<!-- Chat Window (Initially Hidden) -->
<div id="chatWindow" style="display: none; position: fixed; bottom: 70px; right: 20px; width: 350px; height: 450px; border: 1px solid #ccc; border-radius: 15px; background-color: white; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); z-index: 100;">
    <!-- Header with Dark Gray Background -->
    <div style="background-color: #333; padding: 12px; color: white; font-weight: bold; border-top-left-radius: 15px; border-top-right-radius: 15px; display: flex; justify-content: space-between; align-items: center;">
        <span>Chat with Vendor</span>
        <button onclick="closeChatWindow()" style="background: transparent; border: none; color: white; font-size: 20px; cursor: pointer;">&times;</button>
    </div>
    
    <!-- Chat Messages -->
    <div id="chatMessages" style="padding: 12px; height: 320px; overflow-y: auto; border-bottom: 1px solid #ccc; color: black; background-color: white;">
        <!-- Messages will appear here -->
    </div>
    
    <!-- Input Area -->
    <div style="padding: 12px; border-top: 1px solid #ccc; display: flex; align-items: center; background-color: #f5f5f5;">
        <input id="chatInput" style="flex: 1; padding: 10px; border-radius: 8px; border: 1px solid #aaa; background-color: white; color: black; font-size: 14px;" placeholder="Type your message...">
        <button onclick="sendMessage()" style="background-color: #333; color: white; padding: 10px; border-radius: 50%; border: none; margin-left: 10px; font-size: 16px; cursor: pointer; width: 42px; height: 42px; display: flex; justify-content: center; align-items: center;">
            &#10148;
        </button>
    </div>
</div>
    <!-- END fast view of a product -->

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="/assets/plugins/respond.min.js"></script>  
    <![endif]-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="/assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="/assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='/assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <script src="/assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initTwitter();
        });
    </script>

    <script>
        document.getElementById("sidebarToggle").onclick = function() {
            var sidebar = document.querySelector(".sidebar-menu");
            sidebar.classList.toggle("toggle-show");
        }
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Page Loaded");
        });
    </script>
    <script>
        $(document).ready(function() {
    // Toggle the visibility of the details when an expandable row is clicked
    $(".expandable").click(function() {
        // Find the next sibling div that contains the details
        var $details = $(this).next(); 

        // Find the corresponding expand icon within the clicked row
        var $icon = $(this).find(".expand-icon");

        // Toggle the visibility of the details div (show or hide)
        $details.slideToggle();

        // Change the icon text to "-" when the details are shown, and "+" when hidden
        if ($details.is(":visible")) {
            $icon.text("-");  // Change to '-' when expanded
        } else {
            $icon.text("+");  // Change to '+' when collapsed
        }
    });
});

    </script>
    <script>
        // Open the chat window
function openChatWindow() {
    document.getElementById('chatWindow').style.display = 'block';
}

// Close the chat window
function closeChatWindow() {
    document.getElementById('chatWindow').style.display = 'none';
}

// Send a message and update the chat window
function sendMessage() {
    var message = document.getElementById('chatInput').value;
    if (message.trim() !== "") {
        var chatMessages = document.getElementById('chatMessages');
        
        // Create a new message element
        var messageDiv = document.createElement('div');
        messageDiv.style.marginBottom = '10px';
        messageDiv.style.textAlign = 'right';
        messageDiv.innerHTML = "<div style='display: inline-block; padding: 10px; background-color: #e5e5e5; border-radius: 10px; max-width: 70%;'>" + message + "</div>";
        
        // Append the new message
        chatMessages.appendChild(messageDiv);
        
        // Clear the input field
        document.getElementById('chatInput').value = "";

        // Scroll to the bottom of the chat window
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Simulate a response from the vendor after a short delay
        setTimeout(function() {
            var responseDiv = document.createElement('div');
            responseDiv.style.marginBottom = '10px';
            responseDiv.style.textAlign = 'left';
            responseDiv.innerHTML = "<div style='display: inline-block; padding: 10px; background-color: #f1f1f1; border-radius: 10px; max-width: 70%;'>" + "Thank you for your question, we'll get back to you shortly." + "</div>";

            // Append the vendor's response
            chatMessages.appendChild(responseDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 1000);
    }
}

    </script>
 
<script>
function showDocumentPopup(url) {
    let viewer = document.getElementById("document-viewer");
    viewer.innerHTML = ""; // Clear previous content

    // Ensure the full path is used with the domain
    // Check if the URL is relative and prepend the domain if needed
    if (!url.startsWith("http://") && !url.startsWith("https://")) {
        url = "https://flying411.com/" + url; // Replace `yourdomain.com` with your actual domain
    }

    let fileExtension = url.split('.').pop().toLowerCase();
    let supportedImages = ["jpg", "jpeg", "png", "gif"];
    
    if (fileExtension === "pdf") {
        viewer.innerHTML = `<iframe src="${url}" width="100%" height="500px" frameborder="0"></iframe>`;
    } else if (supportedImages.includes(fileExtension)) {
        viewer.innerHTML = `<img src="${url}" style="max-width: 100%; height: auto;" />`;
    } else if (["doc", "docx"].includes(fileExtension)) {
        // Encode the URL for Google Docs Viewer to handle spaces and special characters
        viewer.innerHTML = `<iframe src="https://docs.google.com/gview?url=${encodeURIComponent(url)}&embedded=true" width="100%" height="500px"></iframe>`;
    } else {
        viewer.innerHTML = `<p>Preview not available for this file type. <a href="${url}" target="_blank">Open manually</a>.</p>`;
    }

    document.getElementById("document-popup").style.display = "flex";
}

function closeDocumentPopup() {
    document.getElementById("document-popup").style.display = "none";
    document.getElementById("document-viewer").innerHTML = ""; // Clear content
}
</script>
 <script>
$(document).ready(function() {
    function toggleLoginButton() {
        if ($(window).width() <= 768) { // Mobile screen (adjust breakpoint as needed)
            $("li:last-child").show(); // Show login button on mobile
        } else {
            $("li:last-child").hide(); // Hide login button on larger screens
        }
    }

    // Run on page load
    toggleLoginButton();

    // Run on window resize
    $(window).resize(function() {
        toggleLoginButton();
    });
});

 </script>
 
 <script>
    $('#view-documents-toggle').on('click', function () {
        $('#document-list').slideToggle();

        $('.doc-row').each(function () {
            const isFlex = $(this).css('display') === 'flex';

            if (isFlex) {
                // Remove flex styles
                $(this).css({
                    'display': '',
                    'flex-direction': ''
                });
            } else {
                // Apply flex styles
                $(this).css({
                    'display': 'flex',
                    'flex-direction': 'column'
                });
            }
        });
    });
</script>

</body>
<!-- END BODY -->
</html>