<?php
require 'config.php'; // Include database connection

// Fetch all approved aircraft
$stmt = $pdo->prepare("SELECT * FROM aircrafts WHERE status = 'approved' ORDER BY created_at DESC LIMIT 3");
$stmt->execute();
$aircrafts = $stmt->fetchAll();

$stmt->execute();
$aircrafts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch aircraft images
$aircraftImages = [];
$stmt = $pdo->prepare("SELECT * FROM product_images WHERE product_type = 'aircraft' ORDER BY sort_order ASC ");
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($images as $image) {
    $aircraftImages[$image['product_id']][] = $image['image_url'];
}

// Fetch all approved engines
$stmt = $pdo->prepare("SELECT * FROM engines WHERE status = 'approved' ORDER BY created_at DESC  LIMIT 3");
$stmt->execute();
$engines = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch engine images
$engineImages = [];
$stmt = $pdo->prepare("SELECT * FROM product_images WHERE product_type = 'engine' ORDER BY sort_order ASC ");
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($images as $image) {
    $engineImages[$image['product_id']][] = $image['image_url'];
}

$stmt = $pdo->prepare("SELECT * FROM parts WHERE status = 'approved' ORDER BY created_at DESC  LIMIT 3");
$stmt->execute();
$parts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch part images
$partImages = [];
$stmt = $pdo->prepare("SELECT * FROM product_images WHERE product_type = 'part' ORDER BY sort_order ASC");
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($images as $image) {
    $partImages[$image['product_id']][] = $image['image_url'];
}



$stmt = $pdo->prepare("SELECT * FROM articles ORDER BY created_at DESC");
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Home</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



<!-- SEO Meta -->
<meta name="description" content="Flying411 is a global aviation marketplace for aircraft sales, engines, and aircraft parts. Find listings for aircraft for sale, aviation services, and expert insights in one place.">
<meta name="keywords" content="aircraft for sale, aviation marketplace, buy aircraft, sell aircraft, aircraft engines, aviation parts, aviation maintenance, used aircraft, private jets, airplanes for sale, aircraft trading platform">
<meta name="author" content="Flying411">

<!-- Open Graph Meta (for Social Sharing) -->
<meta property="og:site_name" content="Flying411">
<meta property="og:title" content="New & Used Aircraft, Engines, and Aviation Parts for Sale">
<meta property="og:description" content="Discover premium aircraft, engines, and aviation parts on Flying411. Trusted platform for aviation professionals and aircraft traders.">
<meta property="og:type" content="website">
<meta property="og:image" content="https://flying411.com/assets/corporate/img/Hangar-2-4-White-Final-1.png"> <!-- Replace with your actual image URL -->
<meta property="og:url" content="https://flying411.com">

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
  <!-- Theme styles START -->
  <link href="assets/pages/css/components.css" rel="stylesheet">
  <link href="assets/pages/css/slider.css" rel="stylesheet">
  <link href="assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
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
   font-family: "EB Garamond", serif !important;
}
    .ecommerce .header-navigation ul li a:hover {
	color: blue;
}

.pre-footer li a:hover{
  color: blue;
}
    .page-video {
      position: relative;
      overflow: hidden;
    }

    .video-container {
      position: relative;
      height: 80vh;
      width: 100%;
    }

    .video-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }

    .video-overlay {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      color: #fff;
    }

    .video-title {
      font-size: 50px;
      line-height: 1.5;
      font-weight: bold;
      margin-bottom: 20px;
    }

  

    .video-subtitle {
      font-size: 18px;
      margin-bottom: 20px;
    }


    /* Ensure consistent image size */
    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: cover;
      /* Ensures images are cropped proportionally */
    }

    /* Adjust card content layout */
    .card-title {
      font-size: 1.4rem;
      font-weight: bold;
    }

    .card-text {
      font-size: 12px;
    }

    /* Customize Add to Cart button */
    .btn-primary {
      background-color: blue;
      color: white;
      font-size: 12px;
      font-weight: bold;
      padding: 8px 20px;
      border-radius: 5px;
      /* Aircraft-inspired blue */
      border: none;
    }

    .btn-primary:hover {
      background-color: #003780;
    }


    .blog-card img {
      border-radius: 10px;
      max-height: 200px;
      object-fit: cover;
    }

    .blog-card {
      transition: transform 0.3s ease-in-out;
    }

    .blog-card:hover {
      transform: scale(1.05);
    }

    .carousel-inner {
      padding: 10px 0;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      /* background-color: rgba(0, 0, 0, 0.6); */
      border-radius: 50%;
    }

    .blog-card-title {
      font-weight: bold;
      font-size: 22px;
      color: black;
    }

    .blog-card-desc {
      color: #666;
      font-size: 13px;
    }

    .featured-items {
      text-align: center;
      /*padding: 20px;*/
    }

    .featured-items h1 {
      margin-bottom: 20px;
      font-size: 35px;
      font-weight: 400;
    }

    .items-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .item-card {
      width: 300px;
      position: relative;
      border: 1px solid #ddd;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: left;
    }

    .item-card img {
      width: 100%;
      height: auto;
    }

    .item-card .item-info {
      padding: 15px;
    }

    .item-card .price {

      font-size: 18px;
      margin: 10px 0;
    }

    .item-card .model {
      color: gray;
      font-size: 14px;
    }

    .item-card .add-to-cart {
      background: #007bff;
      color: white;
      text-align: center;
      padding: 10px;
      cursor: pointer;
      text-decoration: none;
      display: block;
      border-radius: 5px;
    }

    .item-card .add-to-cart:hover {
      background: #0056b3;
    }
    
    @media (max-width: 768px) {
      .item-card {
        width: 100%;
      }
    }

    /* General Styling for the Card */
    .item-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      width: 300px;
      margin: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .image-container {
      position: relative;
      width: 100%;
    }

    .image-container img {
      width: 100%;
      height: 300px;
      border-bottom: 1px solid #ddd;
    }

    /* Bookmark Icon Styling */
    .bookmark-icon {
      position: absolute;
      top: 0px;
      right: 0px;
      font-size: 20px;
      color: lightslategrey;
      background: rgba(255, 255, 255, 0.8);
      padding: 8px 9px 16px 21px;
      border-radius: 0px 0px 0px 35px;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .bookmark-icon:hover {
      color: #007bff;
    }

    /* Item Info Styling */
    .item-info {
      padding: 15px;
      text-align: left;
    }

    .item-info h3 {
      font-size: 15px;
      color: black;
      font-weight: bold;
      text-align: left;
      /*font-family: "Roboto", sans-serif;*/
      font-family: "EB Garamond", serif;
      
      margin-bottom: 10px;
    }

    .item-info .price {
      color: #555;
      font-weight: bold;
      margin: 5px 0;
      font-size: 14px;
    }

    .item-info .model {
      color: #555;
      font-size: 14px;
      font-weight: bold;
    }
    @media (max-width: 560px) {
      .item-card {
        width: 100% !important;
      }
    }
    .header-navigation ul li a{
      color: white !important;
    }
    
    .header-navigation ul li a:hover{
      background-color: transparent;
      color: #555;
    }
    body {
      background: #f5f5f5;
    }

    .cards-container {
      display: flex !important;
      flex-wrap: wrap !important;
      gap: 1.5rem !important;
      max-width: 1200px !important;
      margin: 0 auto !important;
    }
    
    /* Card */
    .car-card {
      background: #fff !important;
      border-radius: 8px !important;
      overflow: hidden !important;
      border: 1px solid #DDDDDD !important;
      display: flex !important;
      flex-direction: column !important;
      width: 32% !important;
    }

    /* Slider Container */
    .slider {
      position: relative !important;
      width: 100% !important;
      /* Fixed height so images are consistent */
      height: 250px !important;
      overflow: hidden !important;
    }

    /* "NEW" TAG at top-left */
   .new-tag {
      position: absolute !important;
      top: 10px !important;
      left: 10px !important;
      background: #fff !important;
      color: #444 !important;
      padding: 1rem 1.5rem !important;
      border-radius: 4px !important;
      font-size: 0.75rem !important;
      text-transform: uppercase !important;
      font-weight: 700 !important;
      box-shadow: 0 1px 2px rgba(0,0,0,0.15) !important;
      z-index: 2 !important;
    }

    /* Slider Images */
   /* Container for the slides */
.slides {
    display: flex !important;
    transition: transform 0.4s ease !important;
    height: 100% !important;
}

/* Style for each image inside the slide */
.slides img {
    width: 100% !important;  /* Each image takes full width */
    height: auto !important;
    object-fit: cover !important;
}


    /* Left/Right Arrows */
    .arrows {
      position: absolute !important;
      top: 50% !important;
      width: 100% !important;
      display: flex !important;
      justify-content: space-between !important;
      transform: translateY(-50%) !important;
      opacity: 0 !important;
      transition: opacity 0.3s ease !important;
      z-index: 2 !important;
    padding: 0 0.5rem !important; /* Some horizontal breathing room */
    }
    .arrows span {
      background-color: #fff !important;
      color: #444 !important;
      border: 1px solid #444 !important;
      width: 32px !important;
      height: 32px !important;
      border-radius: 50% !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      cursor: pointer !important;
      user-select: none !important;
      transition: background-color 0.3s, color 0.3s !important;
    }
    .arrows span:hover {
      background-color: #444 !important;
      color: #fff !important;
    }

    /* Favorite + List Icons on the top-right */
    .favorite-icons {
      position: absolute !important;
      top: 0px !important;
      right: 0px !important;
      display: flex !important;
      gap: 0.4rem !important;
      z-index: 2 !important;
      opacity: 0 !important;
      transition: opacity 0.3s ease !important;
      background-color: #fff !important;
      padding: 12px 5px 20px 15px;
      border-radius: 0px 0px 0px 40px !important;
    }
  
    .favorite-icons i:hover {
      background-color: #444 !important;
      color: #fff !important;
    }

    /* Slider Dots at bottom-center */
    .slider-dots {
      position: absolute !important;
      bottom: 10px !important;
      width: 100% !important;
      display: flex;
      justify-content: center !important;
      gap: 0.5rem !important;
      z-index: 2 !important;
      opacity: 0 !important;
      transition: opacity 0.3s ease;
    }
    .dot {
      width: 8px !important;
      height: 8px !important;
      background: #ccc !important;
      border-radius: 50% !important;
      cursor: pointer !important;
      transition: background-color 0.3s !important;
    }
    .dot.active {
      background: #444 !important;
    }

    /* Show arrows, favorite icons, and dots on hover */
    .slider:hover .arrows,
    .slider:hover .favorite-icons,
    .slider:hover .slider-dots {
      opacity: 1 !important;
    }

    /* Card info */
    .car-info {
      padding: 1rem !important;
    }
    .car-info h3 {
      /* margin-bottom: 0.5rem !important; */
      font-size: 1.2rem !important;
      color: #444 !important;
    }
    .car-info p {
      margin: 15px 10px  !important;
      color: #000 !important;
      font-size: 18px;
    }
    .car-info p strong{
      padding-right: 10px;
    }
    .button-group {
      margin-top: 1rem !important;
      display: flex !important;
      gap: 1rem !important;
    }
    .button-group button {
      /* flex: 1; */
      border: none !important;
      width: 100%; 
      padding: 1.2rem !important;
      cursor: pointer;
      margin-top: 15px;
      margin-bottom: 10px;
      border-radius: 4px !important;
      font-weight: bold !important;
      transition: background 0.3s ease, color 0.3s ease !important;
    }
    .button-group button:nth-child(1) {
      background-color: #fff !important;
      color: #444 !important;
      border: 1px solid #444 !important;
    }
    .button-group button:nth-child(1):hover {
      background-color: lightgray !important;
      color: black !important;
      border: 1px solid black !important;

    }
    @media (max-width: 1100px) {
      .car-card {
        width: 40% !important;
      }
      .cards-container{
       justify-content: center !important;
      }
    }
    @media (max-width: 900px) {
      .car-card {
        width: 48% !important;
      }
      .cards-container{
       justify-content: center !important;
      }
    }
    /* Responsive Tweaks */
    @media (max-width: 768px) {
      .arrows span {
        width: 28px;
        height: 28px;
      }
      .favorite-icons i {
        padding: 0.3rem;
      }
      .car-info h3 {
        font-size: 1rem;
      }
      .car-card{
        width: 100% !important;
      }
    }
    .load-more {
      margin: 30px 0px;
      width: 100% !important;
  text-align: center !important;
}

.load-more-btn {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: 500;
  color: #444; /* Dark gray text */
  background-color: #fff; /* White background */
  border: 1px solid #DDDDDD; /* Border matching text color */
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.load-more-btn:hover {
  background-color: #444;
  color: #fff;
}
.car-info p img{
  width:25px;
  color:red !important;
}
.car-info p{
  color:#757575 !important;
}
.site-logo img{
    border-radius: 50% !important;
}
 .service-links {
        background: #f8f8f8;
        padding: 0px 0px 40px 0px;
        text-align: center;
    }
    
     .service-links .container {
        max-width: 1230px;
        margin: auto;
        padding: 0 20px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        
    }

    .service-item {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-decoration: none;
        color: #333;
        font-size: 14px;
        transition: 0.3s;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 12px !important;
    }

    .service-item img {
        max-width: 60px;
        margin-bottom: 10px;
    }
    .service-item h3{
        margin: 12px 0px;
    }

    .service-item p{
        line-height:25px;
    }
    .service-item:hover {
        background: #e0e0e0;
        transform: scale(1.05);
    }

    /* Responsive Styles */
    @media (max-width: 1024px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .grid {
            grid-template-columns: 1fr;
        }
        .service-item {
            padding: 15px;
        }
        
    }

    @media (max-width: 480px) {
        .service-item img {
            max-width: 50px;
        }
        .service-item h3 {
            font-size: 18px;
        }
        .service-item p {
            font-size: 14px;
        }
    }
    .top-cart-block a:hover{
        background-color: white;
        color: black
        border: 1px solid black;;
    }
    .header .top-cart-block a:hover{
    background-color: white!important;
    color: black !important; 
    border: 1px solid black !important;
}

   }



.search-wrapper {
    position: relative;
    display: inline-block;
    margin-top: 10vh;
  }
  
.search-wrapper .serchicon{
      position: absolute;
    top: 16px;
    left: 12px;
  }
.search-wrapper .serchicon img{
    width: 30px;
    height: 28px;
}
  .search-input {
    
    padding: 16px 15px 15px 48px;
    width: 550px;
    border-radius: 30px !important;
    border: none;
    font-size: 17px;
    font-weight: 400;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    outline: none;
    background: white;
    color: #142238;
  }

  .type-tag {
    font-size: 12px;
   padding: 1px 6px 5px 6px;
   border-radius: 20px !important;
    border-radius: 4px;
    margin-right: 8px;
    background: #1e3a8a;
    color: #fff;
  }

  .tag-aircraft {
    background-color: #065f46;
    text-transform: capitalize;
}
  .tag-engine { background-color: #1e40af;  text-transform: capitalize; }
  .tag-part { background-color: #991b1b;  text-transform: capitalize; }
  .tag-service { background-color: #9d174d;  text-transform: capitalize; }

  .suggestion-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #334155;
    cursor: pointer;
  }

  .suggestion-item:hover {
    background-color: #1e293b;
  }
 #suggestionList {
  max-height: 200px; /* or use any height you prefer like 20rem */
  overflow-y: auto;
  overflow-x: hidden;
  position: fixed;
  width: 100%;
  border-radius: 30px  !important;
   background-color: #1e293b;
    scrollbar-width: thin;               /* Firefox */
  scrollbar-color: #999 transparent;
}
#suggestionList::-webkit-scrollbar {
  width: 6px; /* Thin scrollbar */
}

#suggestionList::-webkit-scrollbar-track {
  background: transparent;
}

#suggestionList::-webkit-scrollbar-thumb {
  background-color: #999;
  border-radius: 4px;
}

  
 /* Responsive adjustments */
@media (max-width: 1024px) {
  .search-input {
    width: 500px;
    padding: 16px 15px 15px 48px;
    font-size: 15px;
  }
}

@media (max-width: 768px) {
  .search-input {
     width: 60vw;
    padding: 16px 15px 15px 48px;
    font-size: 14px;
  }
}

@media (max-width: 480px) {
    
/* Style for each image inside the slide */
.slides img {
    width: 100% !important;  /* Each image takes full width */
    height: auto !important;
    object-fit: cover !important;
}
  .search-input {
    width: 90vw;
     padding: 16px 15px 15px 48px;
    font-size: 14px;
  }
  .search-wrapper .serchicon{
      top:47px;
  }

  #suggestionBox li {
    font-size: 14px;
    flex-direction: column;
    align-items: flex-start;
  }

  #suggestionBox li .type-tag {
    margin-top: 6px;
    margin-left: 0;
  }

  .search-wrapper {
    margin-top: 5vh;
  }
}



.slides img{
    min-width:100% !important;
}
  </style>
</head> 
<!-- Head END -->

<!-- Body BEGIN -->

<body class="ecommerce">
  <div class="page-video margin-bottom-35">
    <div class="header" style="background-color: transparent !important;position: absolute; top:0px; width: 100%; border:none; color: white;">
      <div class="container-fluid headlogo" style="display: flex; justify-content: space-between; align-items: center;border: none; color: white !important;">
        <a class="site-logo" href="/"><img src="assets/corporate/img/Hangar-2-4-White-Final-1.png"
            alt="Metronic Shop UI"></a>
  
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
       <li style="display:none;"><?php if (isset($_SESSION['user_id'])): ?>
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
        <!--END CART -->
      </div>
    </div>
    <div class="video-container">
  <!-- Video Background -->
  <video autoplay muted loop playsinline class="video-bg">
    <source src="The Ultramodern Gulfstream Fleet (1).mp4" type="video/mp4">
  </video>

  <!-- Centered Text Content -->
  <div class="video-overlay text-center">
    <div class="search-wrapper relative mx-auto w-full max-w-xl">
      
      <span class="serchicon">
      <img src="assets/corporate/img/search.png">    
      </span>
      <input type="text" id="searchInput" class="search-input w-full border rounded" placeholder="" autocomplete="off">
      <div id="suggestionBox" class="absolute left-0 right-0 bg-blue-900 text-white rounded-xl shadow-lg mt-2 z-50 hidden max-h-80 overflow-y-auto">
        <ul id="suggestionList" class="space-y-2"></ul>
      </div>
    </div>
  </div>
</div>
  </div>
  <!-- END SLIDER -->





 <div class="featured-items">

    <h1>Featured Aircraft</h1>
    <div class="cards-container" id="aircraft-list">
        <?php foreach (array_slice($aircrafts, 0, 3) as $aircraft): ?>
        <?php
// Create a URL-safe slug from aircraft model
$slug = strtolower(str_replace([' ', '/'], '-', $aircraft['model']));
?>

            <div class="car-card">
                <div class="slider" data-current-slide="0">
                    <span class="new-tag" style="font-size: 10px !important;">NEW</span>
                    <div class="favorite-icons">
                        <img src="assets/pages/img/icons/ribbon.png" width="25px" alt="">
                    </div>
                   <a href="/<?= urlencode($slug) ?>/<?= $aircraft['aircraft_id'] ?>">
                        <div class="slides">
                            <?php if (!empty($aircraftImages[$aircraft['aircraft_id']])): ?>
                                <?php foreach ($aircraftImages[$aircraft['aircraft_id']] as $image): ?>
                                    <?php
                                        $vendorPath = 'vendors/' . $image;
                                        $clientPath = 'clients/' . $image;
                                        $finalPath = file_exists($vendorPath) ? $vendorPath : (file_exists($clientPath) ? $clientPath : '');
                                    ?>
                                    <img src="<?= !empty($finalPath) ? '/' . $finalPath : '/assets/pages/img/products/default-aircraft.jpg' ?>" alt="Aircraft Image">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <img src="/assets/pages/img/products/default-aircraft.jpg" alt="Default Aircraft Image">
                            <?php endif; ?>
                        </div>
                    </a>

                    <div class="arrows">
                        <span class="arrow-left"><img src="assets/pages/img/icons/left-chevron.png" width="17px" alt=""></span>
                        <span class="arrow-right"><img src="assets/pages/img/icons/right-arrow-angle.png" width="17px" alt=""></span>
                    </div>
                    <div class="slider-dots">
                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
                <div class="car-info" style="text-align: left; font-size: 16px;">
                    <h2 style="margin:20px 0px 30px 15px; font-size: 23px !important; letter-spacing: 1.5px; color: #000; font-weight: 500;">
                        <?= htmlspecialchars($aircraft['model']) ?>
                    </h2>
                    <p><img src="assets/pages/img/icons/calendar (2).png" alt="">&nbsp;Year<span style="padding-left: 93px;"> <?= htmlspecialchars($aircraft['year']) ?></span></p>
                    <p><img src="assets/pages/img/icons/time-management (1).png" alt="">&nbsp;Total Time <span style="padding-left: 40px;"> <?= htmlspecialchars($aircraft['total_time_hours']) ?> hours</span></p>
                    <p><img src="assets/pages/img/icons/engines.png" alt="">&nbsp;Engine <span style="padding-left: 70px;"><?= htmlspecialchars($aircraft['engine1_hours']) ?>&nbsp;(<?= htmlspecialchars($aircraft['engine1_status'])?>)</span></p>
                    <h2 style="margin-top:40px;margin-left: 15px; font-size: 30px !important; color: #000; font-weight: 500;">
                                <?php if ($aircraft['price_label'] === 'call'): ?>
                                    <h2 style="margin-top:50px;margin-left: 15px; font-size: 22px !important; color: #000; font-weight: 500;">Call for Price </h2>
                                <?php else: ?>
                                    $<?= number_format($aircraft['price']) ?>
                                <?php endif; ?>
                            </h2>
                    <p><img src="assets/pages/img/icons/location.png" alt="">&nbsp;<?= htmlspecialchars($aircraft['location']) ?></p>
                     <div class="button-group">
                        <button onclick="window.location.href='/<?= $slug ?>/<?= $aircraft['aircraft_id'] ?>';">More Details</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="load-more" style="text-align: center !important; display:flex; justify-content: center;">
        <button class="load-more-btn" onclick="window.location.href='/aircraft'">View All</button>
    </div>
</div>
  
  
  
  
 <div class="featured-items">
    <h1>Featured Engines</h1>
    <div class="cards-container" id="engine-list">
        <?php foreach (array_slice($engines, 0, 3) as $engine): ?>
          <?php
$engine_slug = str_replace(' ', '_', $engine['model']); // Create slug like "Rotax_912"
?>

            <div class="car-card">
                <div class="slider" data-current-slide="0">
                    <span class="new-tag" style="font-size: 10px !important;">NEW</span>
                    <div class="favorite-icons">
                        <img src="assets/pages/img/icons/ribbon.png" width="25px" alt="">
                    </div>
                    <a href="/engines/<?= $engine_slug ?>/<?= $engine['engine_id'] ?>">
                        <div class="slides">
                            <?php if (!empty($engineImages[$engine['engine_id']])): ?>
                                <?php foreach ($engineImages[$engine['engine_id']] as $image): ?>
                                    <img src="vendors/<?= $image ?>" alt="Engine Image">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <img src="/assets/pages/img/products/default-engine.jpg" alt="Default Engine Image">
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="arrows">
                        <span class="arrow-left"><img src="assets/pages/img/icons/left-chevron.png" width="17px" alt=""></span>
                        <span class="arrow-right"><img src="assets/pages/img/icons/right-arrow-angle.png" width="17px" alt=""></span>
                    </div>
                    <div class="slider-dots">
                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
                <div class="car-info" style="text-align: left; font-size: 16px;">
                    <h2 style="margin: 20px 0px 30px 15px; font-size: 23px !important;letter-spacing: 1.5px; color: #000; font-weight: 500;">
                        <?= htmlspecialchars($engine['model']) ?>
                    </h2>
                    <p><img src="assets/pages/img/icons/calendar (2).png" alt="">&nbsp;Year<span style="padding-left: 110px;"><?= htmlspecialchars($engine['year']) ?></span></p>
                    <p><img src="assets/pages/img/icons/time-management (1).png" alt="">&nbsp;Total Time<span style="padding-left: 60px;"><?= htmlspecialchars($engine['total_time_hours']) ?> hours</span></p>
                    <p><img src="assets/pages/img/icons/time-management (1).png" alt="">&nbsp;HR  <span style="padding-left: 107px;"><?= htmlspecialchars($engine['hr']) ?> hours</span></p>
                    <p><img src="assets/pages/img/icons/time-management (1).png" alt="">&nbsp;CR <span style="padding-left: 109px;"><?= htmlspecialchars($engine['cycles']) ?> cycles</span></p>
                    <p><img src="assets/pages/img/icons/settings.png" alt="">&nbsp;Condition <span style="padding-left: 60px;"><?= htmlspecialchars($engine['condition']) ?></span></p>
                    <h2 style="margin-top:40px;margin-left: 15px; font-size: 30px !important; color: #000; font-weight: 500;">
                        $<?= number_format($engine['price']) ?>
                    </h2>
                     <div class="button-group">
    <button onclick="window.location.href='/engines/<?= $engine_slug ?>/<?= $engine['engine_id'] ?>';">More Details</button>
</div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="load-more" style="text-align: center !important; display:flex; justify-content: center;">
               <button class="load-more-btn" onclick="window.location.href='/engine'">View All</button>
    </div>
</div>


 
    <div class="featured-items">
        <h1>Featured Parts</h1>
    <div class="cards-container" id="part-list">
        <?php foreach (array_slice($parts, 0, 3) as $part): ?>
          <?php
$part_slug = str_replace(' ', '_', $part['part_name']); // Slug example: Engine_Filter
?>
            <div class="car-card">
                <div class="slider" data-current-slide="0">
                    <span class="new-tag" style="font-size: 10px !important;">NEW</span>
                    <div class="favorite-icons">
                        <img src="assets/pages/img/icons/ribbon.png" width="25px" alt="">
                    </div>
                   <a href='/parts/<?= $part_slug ?>/<?= $part['part_id'] ?>';>
                        <div class="slides">
                            <?php if (!empty($partImages[$part['part_id']])): ?>
                                <?php foreach ($partImages[$part['part_id']] as $image): ?>
                                    <img src="vendors/<?= $image ?>" alt="Part Image">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <img src="/assets/pages/img/products/default-part.jpg" alt="Default Part Image">
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="arrows">
                        <span class="arrow-left"><img src="assets/pages/img/icons/left-chevron.png" width="17px" alt=""></span>
                        <span class="arrow-right"><img src="assets/pages/img/icons/right-arrow-angle.png" width="17px" alt=""></span>
                    </div>
                    <div class="slider-dots">
                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
                <div class="car-info" style="text-align: left; font-size: 16px;">
                    <h2 style="margin:20px 0px 30px 15px; font-size: 23px !important;letter-spacing: 1.5px; color: #000; font-weight: 500;">
                        <?= htmlspecialchars($part['part_name']) ?>
                    </h2>
                    <p><img src="assets/pages/img/icons/license-plate.png" alt="">&nbsp;Part Number <span style="padding-left: 60px;"> <?= htmlspecialchars($part['part_number']) ?> </span></p>
                    <p><img src="assets/pages/img/icons/settings.png" alt="">&nbsp;Condition <span style="padding-left: 79px;"> <?= htmlspecialchars($part['condition']) ?> </span></p>
                    <p><img src="assets/pages/img/icons/shopping.png" alt="">&nbsp;Tag <span style="padding-left: 130px;"> <?= htmlspecialchars($part['tagged_with_easa_form_1']) ?> </span></p>
                    <h2 style="margin-top:40px;margin-left: 15px; font-size: 30px !important; color: #000; font-weight: 500;">
                        $<?= number_format($part['price']) ?>
                    </h2>
                      <div class="button-group">
    <button onclick="window.location.href='/parts/<?= $part_slug ?>/<?= $part['part_id'] ?>';">More Details</button>
</div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="load-more" style="text-align: center !important; display:flex; justify-content: center;">
      <button class="load-more-btn" onclick="window.location.href='/parts'">View All</button>
    </div>
</div>


  </div>



 <div class="container my-5">
  <h2 class="text-center mb-4" style="font-size: 40px;">Our Latest Blogs</h2>

  <!-- Multi-Item Blog Carousel -->
 <div id="blogCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <!-- JS will insert slides here -->
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
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
            <li><i class="fa fa-angle-right"></i> <a href="contacts/">Contact Us</a></li>
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
            <img src="assets/pages/img/products/product1.jpg" alt="Cool green dress with red bell"
              class="img-responsive">
          </div>
          <div class="product-other-images">
            <a href="javascript:;" class="active"><img alt="Berry Lace Dress"
                src="assets/pages/img/products/product2.jpg"></a>
            <a href="javascript:;"><img alt="Berry Lace Dress" src="assets/pages/img/products/air1.jpg"></a>
            <a href="javascript:;"><img alt="Berry Lace Dress" src="assets/pages/img/products/air3.jpg"></a>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-9">
          <h2>Lorem ipsum dolor sit amet.</h2>
          <div class="price-availability-block clearfix">
            <div class="price">
              <strong><span></span>Details</strong>

            </div>
          </div>
          <div class="description">
            <p>Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna
              aliquarm erat volutpat Nostrud duis molestie at dolore.</p>
          </div>
          <div class="product-page-cart">
            <div class="product-quantity">
              <input id="product-quantity" type="text" value="1" readonly name="product-quantity"
                class="form-control input-sm">
            </div>
            <button class="btn btn-primary" type="submit">Chat with Dealer</button>
            <a href="#" class="btn btn-default">More details</a>
          </div>
        </div>

        <div class="sticker sticker-sale"></div>
      </div>
    </div>
  </div>
  <!-- END fast view of a product -->

  <!-- Load javascripts at bottom, this will reduce page load time -->
  <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
  <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>  
    <![endif]-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
  <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
  <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <!-- END CORE PLUGINS -->

  <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
  <script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script>
  <!-- slider for products -->
  <script src='assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
  <script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
  <!-- Quantity -->

  <script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
  <script src="assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function () {
      Layout.init();
      Layout.initOWL();
      Layout.initImageZoom();
      Layout.initTouchspin();
      Layout.initTwitter();
    });
  </script>
  <!-- END PAGE LEVEL JAVASCRIPTS -->
  <script>
  document.querySelectorAll('.car-card .slider').forEach((slider) => {
          const slidesContainer = slider.querySelector('.slides');
          const leftArrow = slider.querySelector('.arrow-left');
          const rightArrow = slider.querySelector('.arrow-right');
          const dots = slider.querySelectorAll('.dot');
          const slides = slidesContainer.children;
          const totalSlides = slides.length;
          let currentSlide = 0;
      
          function updateSlide() {
              // Calculate the correct width of a single slide
              const slideWidth = slider.clientWidth;
              slidesContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
              
              // Update dots to reflect the active slide
              dots.forEach((dot, index) => {
                  dot.classList.toggle('active', index === currentSlide);
              });
          }
      
          leftArrow.addEventListener('click', () => {
              currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
              updateSlide();
          });
      
          rightArrow.addEventListener('click', () => {
              currentSlide = (currentSlide + 1) % totalSlides;
              updateSlide();
          });
      
          dots.forEach((dot, index) => {
              dot.addEventListener('click', () => {
                  currentSlide = index;
                  updateSlide();
              });
          });
      
          // Ensure slides have the correct width on page load
          window.addEventListener('resize', updateSlide);
          updateSlide(); // Initial update
      });

   
   </script>
  <script>
document.addEventListener("DOMContentLoaded", function () {
  const carouselInner = document.querySelector(".carousel-inner");

  // This should be generated by PHP and injected as JSON
  const blogData = <?php echo json_encode($articles); ?>;

  function createCard(article) {
    return `
      <div class="col-md-4 mb-4">
        <div class="card blog-card h-100">
          <img src="admin/uploads/${article.image}" class="card-img-top" style="width:100%;height:250px;object-fit:cover;" alt="${article.title}">
          <div class="card-body d-flex flex-column">
            <h5 class="blog-card-title">${article.title}</h5>
            <a href="blog-details.php?id=${article.id}&slug=${encodeURIComponent(article.slug)}"
              class="btn btn-sm mt-auto"
              style="background-color: #fff; color: black; border: 1px solid #666; padding: 8px 50px; font-size: 12px; font-weight: 400; border-radius: 4px;">
              Read More
            </a>
          </div>
        </div>
      </div>
    `;
  }

  function updateCarousel() {
    const width = window.innerWidth;
    let itemsPerSlide = 3;
    if (width < 576) itemsPerSlide = 1;
    else if (width < 993) itemsPerSlide = 2;

    carouselInner.innerHTML = ""; // Clear existing

    for (let i = 0; i < blogData.length; i += itemsPerSlide) {
      const isActive = i === 0 ? 'active' : '';
      let slideContent = '<div class="row">';
      for (let j = i; j < i + itemsPerSlide && j < blogData.length; j++) {
        slideContent += createCard(blogData[j]);
      }
      slideContent += '</div>';

      const item = document.createElement("div");
      item.className = `carousel-item ${isActive}`;
      item.innerHTML = slideContent;
      carouselInner.appendChild(item);
    }
  }

  updateCarousel();
  window.addEventListener("resize", updateCarousel);
});
</script>

<script>
$(document).ready(function() {
  function toggleLoginButton() {
    if ($(window).width() <= 768) {
      $("li:last-child").show();
    } else {
      $("li:last-child").hide();
    }
  }

  toggleLoginButton();
  $(window).resize(toggleLoginButton);
});
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
  const searchInput = document.getElementById('searchInput');
  const suggestionBox = document.getElementById('suggestionBox');
  const suggestionList = document.getElementById('suggestionList');

  const placeholders = ["Aircraft", "Parts", "Engines", "Services"];
  let placeholderIndex = 0;

  function rotatePlaceholder() {
    searchInput.setAttribute("placeholder", `Search for ${placeholders[placeholderIndex]}`);
    placeholderIndex = (placeholderIndex + 1) % placeholders.length;
  }
  rotatePlaceholder();
  setInterval(rotatePlaceholder, 2500);

  // Handle input event
  searchInput.addEventListener('input', async () => {
    const query = searchInput.value.trim();
    if (!query) {
      suggestionBox.classList.add('hidden');
      suggestionList.innerHTML = '';
      return;
    }

    const response = await fetch(`search_suggestions.php?q=${encodeURIComponent(query)}`);
    const results = await response.json();

    let suggestions = '';

    // ✅ Add universal "Search all for..." suggestion
    suggestions += `
      <li class="suggestion-item search-all" data-url="/aircraft?model=${encodeURIComponent(query)}">
        <div class="flex space-x-2">
          <span class="type-tag tag-all bg-blue-600 text-white px-2 py-1 rounded text-xs">Search</span>
          <span>Search all for "<strong>${query}</strong>"</span>
        </div>
      </li>
    `;

    if (results.length === 0) {
      suggestions += '<li class="text-gray-300 px-4 py-2">No results found</li>';
    } else {
      suggestions += results.map(item => {
        let tagClass = '';
        switch (item.type) {
          case 'category': tagClass = 'bg-green-500'; break;
          case 'manufacturer': tagClass = 'bg-purple-500'; break;
          case 'type_designator': tagClass = 'bg-orange-500'; break;
          case 'model': tagClass = 'bg-gray-500'; break;
          case 'engine': tagClass = 'bg-red-500'; break;
          case 'part': tagClass = 'bg-yellow-500'; break;
          default: tagClass = 'bg-blue-500';
        }

        // Handle URL fallback if not returned from PHP (optional, here PHP provides URL only for aircraft)
        let url = item.url;
        if (!url) {
          if (item.type === 'engine') {
            url = `/engine?model=${encodeURIComponent(item.name)}`;
          } else if (item.type === 'part') {
            url = `/parts?name=${encodeURIComponent(item.name)}`;
          } else {
            url = '#';
          }
        }

        return `
          <li class="suggestion-item" data-url="${url}">
            <div class="flex space-x-2">
              <span class="type-tag ${tagClass} text-white px-2 py-1 rounded text-xs">${item.type}</span>
              <span>${item.name}</span>
            </div>
          </li>
        `;
      }).join('');
    }

    suggestionList.innerHTML = suggestions;
    suggestionBox.classList.remove('hidden');
  });

  // ✅ Handle click on suggestions
  suggestionList.addEventListener('click', (e) => {
    const target = e.target.closest('li');
    if (!target) return;

    const url = target.getAttribute('data-url');
    if (url && url !== '#') {
      window.location.href = url;
    }
  });

  // ✅ Hide suggestions on outside click
  document.addEventListener('click', (e) => {
    if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
      suggestionBox.classList.add('hidden');
    }
  });

  // ✅ Enter key triggers universal search
  searchInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();

      const query = searchInput.value.trim();
      if (!query) return;

      suggestionBox.classList.add('hidden');

      // Default: universal aircraft model search
      window.location.href = `/aircraft?model=${encodeURIComponent(query)}`;
    }
  });
</script>



 
</body>
<!-- END BODY -->

</html>