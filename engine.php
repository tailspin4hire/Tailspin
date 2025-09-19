<?php
require 'config.php'; // Include your database connection

$modelFilter = $_GET['model'] ?? '';

if ($modelFilter) {
    // Filter engines by brand extracted from model
    $brand = explode(' ', trim($modelFilter))[0];
    $stmt = $pdo->prepare("SELECT * FROM engines WHERE status = 'approved' AND model LIKE ? ORDER BY created_at DESC");
    $stmt->execute(["%$brand%"]);
    $engines = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // No filter — fetch all approved engines
    $stmt = $pdo->prepare("SELECT * FROM engines WHERE status = 'approved' ORDER BY created_at DESC");
    $stmt->execute();
    $engines = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch condition-wise count (always)
$query = "SELECT `condition`, COUNT(*) as total FROM engines WHERE status = 'approved' GROUP BY `condition`";
$stmt = $pdo->prepare($query);
$stmt->execute();
$conditionCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert condition counts to associative array
$counts = [];
foreach ($conditionCounts as $row) {
    $counts[$row['condition']] = $row['total'];
}

// Fetch manufacturer-wise count (always)
$query = "SELECT manufacturer, COUNT(*) as total FROM engines_details GROUP BY manufacturer";
$stmt = $pdo->prepare($query);
$stmt->execute();
$manufacturerCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert manufacturer counts to associative array
$manufacturers = [];
foreach ($manufacturerCounts as $row) {
    $manufacturers[$row['manufacturer']] = $row['total'];
}

// Fetch engine type count (always)
$query = "SELECT engine_type, COUNT(*) as total FROM engines_details GROUP BY engine_type";
$stmt = $pdo->prepare($query);
$stmt->execute();
$engineTypeCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert engine type counts to associative array
$engineTypes = [];
foreach ($engineTypeCounts as $row) {
    $engineTypes[$row['engine_type']] = $row['total'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
 <!-- Responsive and Compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- SEO Meta -->
<title>Engines</title>
<meta name="description" content="Explore aircraft engines for sale at Flying411. Browse jet engines, turboprop engines, piston engines, and more from global aviation sellers. Filter by condition, manufacturer, engine type, and location.">
<meta name="keywords" content="aircraft engines for sale, jet engines, turboprop engines, piston aircraft engines, used aircraft engines, aviation engine marketplace, overhauled engines, serviceable engines, buy aircraft engines, engine trading, aviation parts marketplace">
<meta name="author" content="Flying411">

<!-- Open Graph Meta (for Social Sharing) -->
<meta property="og:site_name" content="Flying411">
<meta property="og:title" content="Buy Aircraft Engines – Jet, Turboprop & Piston Engines | Flying411">
<meta property="og:description" content="Find the right aircraft engine at Flying411. Trusted global listings for overhauled, factory new, and serviceable aircraft engines. Filter listings by condition, manufacturer, and location.">
<meta property="og:type" content="website">
<meta property="og:image" content="https://flying411.com/assets/corporate/img/Hangar-2-4-White-Final-1.png"> <!-- Replace with your actual OG image for engines -->
<meta property="og:url" content="https://flying411.com/engines">

<!-- Twitter Card Meta -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Aircraft Engines for Sale | Buy Jet & Turboprop Engines Online">
<meta name="twitter:description" content="Browse premium aircraft engine listings at Flying411. Discover factory new, overhauled, and serviceable engines for business and commercial aviation.">
<meta name="twitter:image" content="https://flying411.com/assets/corporate/img/Hangar-2-4-White-Final-1.png"> 

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
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,500,500|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,500,500,900&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,500,500,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->  
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
     font-family: "EB Garamond", serif !important;
}
      .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 95%;
        max-width: 1430px;
            margin: auto;
            padding: 20px 0;
        }

        /* Filter Section */
        .filter-section {
            width: 300px;
            /*background-color: #fff;*/
            /*border: 1px solid #ddd;*/
            border-radius: 8px;
            padding: 15px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        }

        .filter-section h3 {
            font-size: 25px;
            margin: 0 0 20px;
            color: #333;
            /* font-weight: bold; */
        }

        .reset-icon {
            float: right;
            font-size: 16px;
            color: #666;
            cursor: pointer;
            text-decoration: none;
        }

        .filter-item {
            margin-bottom: 15px;
        }

        .filter-item label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 14px;
            color: #555;
            cursor: pointer;
        }

        .filter-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .filter-item .dropdown-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            background-color: #fff;
        }

        .filter-item .dropdown-box:hover {
            background-color: #f4f4f4;
        }

        .expandable-section {
            display: none;
            border-top: 1px solid #ddd;
            margin-top: 10px;
            padding-top: 10px;
        }
        /* Right Section */
        .right-section {
            flex: 1;
            margin-left: 20px;
        }

        
    .advanced-options {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
    }
    .advanced-options label {
        display: flex;
        align-items: center;
        gap: 5px;
    }


        .listing-cards {
            display: flex;
            flex-wrap: wrap;
            width:100%;
            row-gap: 20px;
            column-gap: 20px;
                }

       
        /* Responsive */
     
      .header .mobi-toggler{
    margin:0px !important;
}  
@media (max-width: 768px) {
    .ecommerce .header .mobi-toggler{
        margin:0px !important;
    }
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
      background-color: rgba(0, 0, 0, 0.6);
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
      padding: 20px;
    }

    .featured-items h1 {
      margin-bottom: 20px;
      font-size: 50px;
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
    font-family: "EB Garamond", serif !important;
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
      font-weight: 500 !important;
      box-shadow: 0 1px 2px rgba(0,0,0,0.15) !important;
      z-index: 2 !important;
    }

    /* Slider Images */
    .slides {
      display: flex !important;
      width: 300% !important; /* If 3 slides total, can be 300% */
      transition: transform 0.4s ease !important;
  height: 100% !important
  ;  }
    .slides img {
      width: 35% !important;
      height: 100% !important;
      object-fit: cover !important;
    }
    .header .header-navigation ul li a{
        color:white !important;
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
      color: #black !important;
      border: 1px solid black !important;

    }
    @media (max-width: 1400px) {
      .car-card {
        width: 48% !important;
      }
      .cards-container{
       justify-content: center !important;
      }
    }
     @media (max-width: 1024px) {
 .header .header-navigation ul li a{
        color:black !important;
    }
 }
    @media (max-width: 990px) {
      .car-card {
        width: 100% !important;
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
       .search-bar{
    padding-bottom:30px;
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
.car-info img{
  width:25px;
}
.filter-item select{
    width: 100%;
    padding: 11px;
    border: 1px solid gray;
}
.car-info p{
  color:#757575 !important;
}

.headers {
            position: relative;
            width: 100%;
            height: 80vh;
            /*background: url('/assets/pages/img/products/istockphoto-821986190-612x612.jpg') center center/cover no-repeat;*/
            background: url('/assets/pages/img/products/engine1.jpg') center center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .headers::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .headers h1, .header p {
            position: relative;
            z-index: 2;
        }

        .headers h1 {
            font-size: 4.5rem;
            font-weight: ;
   font-family: "EB Garamond", serif !important;
            margin-top: 100px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .headers p {
            font-size: 1.5rem;
            color:white !important;
            z-index: 2;
            margin: 10px 0 20px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
        }
        .search-bar {
            display: flex;
            justify-content: center;
            gap: 10px;
            width: 100%;
            max-width: 900px;
            position: relative;
            z-index: 2;
        }

        .search-bar select, .search-bar input, .search-bar button {
            padding: 15px;
            font-size: 1.5rem;
            border: none;
            border-radius: 5px;
        }

        .search-bar select {
            flex: 1;
            border: 1px solid white;
            color:#fff;
            border-radius: 10px;
            min-width: 150px;
            appearance: none;
            background: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"%3E%3Cpath fill="%23ccc" d="M2 0L0 2h4zm0 5L0 3h4z"/%3E%3C/svg%3E') no-repeat right 10px center;
            background-size: 12px;
        }
        .search-bar select:focus {
    background-color: #333; /* Keep the background color consistent */
    color: #fff; /* Ensure text color remains white */
    outline: none; /* Optional: Remove default outline */
}

/* Optional: Style the options within the dropdown */
.search-bar select option {
    background-color: #333; /* Set option background color */
    color: #fff; /* Set option text color */
}

/* Optional: If you want the hover effect on options */
.search-bar select option:hover {
    background-color: #555; /* Darker background when hovering over options */
}
        .search-bar input {
            flex: 2;
            min-width: 200px;
            color:black;
            
        }

        .search-bar button {
            background-color: #e30b17;
            color: white;
            cursor: pointer;
            min-width: 120px;
        }

        .search-bar button:hover {
            background-color: #c00914;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .header p {
                font-size: 1rem;
            }

            .search-bar {
                flex-direction: column;
                gap: 15px;
                /*width: 80%;*/
            }
        }
 .filter-section {
    width: 280px;
    /*border: 1px solid #ddd;*/
    padding: 15px;
    /*background: #fff;*/
    /*font-family: Arial, sans-serif;*/
}

.filter-item h4 {
    font-size: 14px;
    /*font-weight: bold;*/
    cursor: pointer;
    padding: 10px;
    background: #f1f1f1;
    margin: 0;
    border: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
   @media (max-width: 768px) {
            .filter-section {
                width: 100%;
                margin-bottom: 20px;
            }

            .right-section {
                width: 100%;
                margin: 0;
            }

           

            .listing-cards {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }

.arrow {
    font-size: 14px;
    color: #333;
}

.filter-content {
    display: flex;
    flex-direction:column;
    overflow-y: scroll;
    height: 184px;
    padding: 10px;
    /*max-height: 200px;*/
    overflow-y: auto;
    background: #f9f9f9;
     white-space: nowrap; 
  position: relative;
   scrollbar-width: thin;
  scrollbar-color: #bbb #f1f1f1;
}
.filter-content::-webkit-scrollbar {
  width: 6px;
}

.filter-content::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.filter-content::-webkit-scrollbar-thumb {
  background: #bbb;
  border-radius: 10px;
}

.filter-content::-webkit-scrollbar-thumb:hover {
  background: #999;
}
.filter-content a {
    display: block;
    padding: 5px;
    font-size: 14px;
    font-weight: 500;
    color: #757575;
}


.submit-btn {
    width: 100%;
    padding: 10px;
    background: #008cba;
    color: white;
    border: none;
    cursor: pointer;
    margin-top: 10px;
    display: none;
}

.selected-filters {
    background: #f8f8f8;
    padding: 23px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
}
.site-logo img{
    border-radius: 50% !important;
    margin-right: 110px !important;
}
.header .top-cart-block{
    margin-left: 70px !important;
}
  .header .top-cart-block a:hover{
    background-color: white!important;
    color: black !important; 
    border: 1px solid black !important;
}

.suggestions-box {
    background: #fff;
    position: absolute;
    max-height: 150px;
    overflow-y: auto;
    top:58px;
    right:240px;
    width: 250px;
    color: black;
}

.suggestions-box div {
    padding: 10px;
    cursor: pointer;
}

.suggestions-box div:hover {
    background: #f0f0f0;
}
@media (min-width: 1200px) {
    .header .container {
        max-width: 1350px !important;
    }
}
@media (min-width: 1025px) {
    .header .container {
        max-width: 1350px !important;
    }
    .header .top-cart-block {
    margin-left: 5px !important;
}
.site-logo img {
    border-radius: 50% !important;
    margin-right: 28px !important;
}

}

@media (max-width: 1024px) {
    .ecommerce .header-navigation > ul > li > a{
     color:white !important;
 }
  .site-logo img{
     margin-right:0px !important;
 } 
 .header .top-cart-block{
         margin-left: 0px !important;
 }
 .header .container, .header .container-md, .header .container-sm{
     max-width:800px;
 }
}


.search-wrapper {
    position: relative;
    display: inline-block;
  }
  
.search-wrapper .serchicon{
      position: absolute;
    top: 14px;
    left: 12px;
  }
.search-wrapper .serchicon img{
    width: 30px;
    height: 28px;
}
  .search-input {
    
    padding: 16px 15px 15px 48px !important;
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
      max-height: 200px  !important; 
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
  max-height: 200px  !important; /* or use any height you prefer like 20rem */
  overflow-y: auto;
  overflow-x: hidden;
  position: absolute;
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
    width: 500px  !important;
    padding: 16px 15px 15px 48px;
    font-size: 15px;
  }
}

@media (max-width: 768px) {
  .search-input {
     width: 60vw  !important;
    padding: 16px 15px 15px 48px !important;
    font-size: 14px !important;
  }
  #suggestionList{
      width:100%;
  }
}

@media (max-width: 480px) {
      .ecommerce .header-navigation > ul > li > a{
     color:black !important;
 }
/* Style for each image inside the slide */
.slides img {
    width: 100% !important;  /* Each image takes full width */
    height: auto !important;
    object-fit: cover !important;
}
  .search-input {
    width: 90vw !important;
     padding: 16px 15px 15px 48px !important;
    font-size: 14px;
  }
  .search-wrapper .serchicon{
      top:14px !important;
  }
#suggestionList{
    width:100%; 
    position: relative !important;
}
  #suggestionBox li {
    font-size: 14px;
    flex-direction: column !important;
    align-items: flex-start !important;
  }

  #suggestionBox li .type-tag {
    margin-top: 6px !important;
    margin-left: 0 !important;
  }

  .search-wrapper {
    margin-top: 5vh !important;
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
  <div class="header" style="position: absolute;width: 100%;">
    <div class="container headlogo" style="display: flex; justify-content: space-between; align-items: center;">
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
 <div class="headers">
    <h1>WELCOME TO AIRCRAFT ENGINES</h1>
    <p style="font-size: 15px; color: white;">Discover Certified Aircraft Engines with Advanced Search Options</p>

    <div class="search-bar">
        <!-- Manufacturer Dropdown -->
        <!--<select id="manufacturer" onchange="updateModels()">-->
            <!--<option value="">Select Manufacturer</option>-->
        <!--</select>-->

        <!-- Model Dropdown -->
        <!--<select id="model">-->
            <!--<option value="">Select Model</option>-->
        <!--</select>-->

        <!-- Search Input with Auto-Suggestions -->
        <!--<input type="text" id="search_query" placeholder="Search by Name, Manufacturer, or Model" onkeyup="fetchSuggestions()" autocomplete="off">-->
        <!--<div id="suggestions" class="suggestions-box"></div>-->

        <!-- Search Button -->
        <!--<button type="button" onclick="searchAircraft()">Search Engine</button>-->
        
        
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

    <!-- Search Results -->
    <div id="results"></div>
</div>





   
<div class="container" style="margin-top: 50px;">
    <!-- Filter Section -->
<div class="filter-section">
  <div style="display: flex;align-items: flex-start;justify-content: space-between;">
    <h3>ENGINES</h3>
    <button class="clear-filters-btn" style="border:none;float:right; padding:5px 10px; font-size:12px; color:black;" onclick="resetFilters()">Clear Filters</button>
  </div>

  <div id="selected-filters" class="selected-filters" style="display: none;">
    <a href="#" class="reset-icon" onclick="resetFilters()">&#x21bb; clear filters</a>
  </div>

  <!-- Condition Filter -->
  <div class="filter-item">
    <h4 onclick="toggleFilter('applications', this)" style="letter-spacing:2px; cursor:pointer;">
      Condition <span class="arrow">&#43;</span>
    </h4>
    <div id="applications" class="filter-content">
      <?php
      $conditions = [
        "Factory New", 
        "Overhauled", 
        "Serviceable", 
        "As Removed", 
        "New Surplus", 
        "Repaired", 
        "Beyond Economic Repair"
      ];

      foreach ($conditions as $condition) {
        $count = isset($counts[$condition]) ? $counts[$condition] : 0;
        echo '<a href="#" class="filter-link" data-filter-type="condition" data-filter-value="' . htmlspecialchars($condition) . '">' . $condition . ' (' . $count . ')</a> ';
      }
      ?>
    </div>
  </div>

  <!-- Location Filter -->
  <div class="filter-item">
    <h4 onclick="toggleFilter('location-filter', this)" style="letter-spacing:2px; cursor:pointer;">
      Location <span class="arrow">&#43;</span>
    </h4>
    <div id="location-filter" class="filter-content">
      <a href="#" class="filter-link" data-filter-type="location" data-filter-value="North America">North America (15)</a> 
      <a href="#" class="filter-link" data-filter-type="location" data-filter-value="Europe">Europe (10)</a> 
      <a href="#" class="filter-link" data-filter-type="location" data-filter-value="Asia">Asia (8)</a> 
      <a href="#" class="filter-link" data-filter-type="location" data-filter-value="Middle East">Middle East (5)</a> 
    </div>
  </div>

  <!-- Manufacturer Filter -->
  <div class="filter-item">
    <h4 onclick="toggleFilter('manufacturer-filter', this)" style="letter-spacing:2px; cursor:pointer;">
      Manufacturer <span class="arrow">&#43;</span>
    </h4>
    <div id="manufacturer-filter" class="filter-content">
      <?php
      foreach ($manufacturers as $manufacturer => $count) {
        echo '<a href="#" class="filter-link" data-filter-type="manufacturer" data-filter-value="' . htmlspecialchars($manufacturer) . '">' . $manufacturer . ' (' . $count . ')</a> ';
      }
      ?>
    </div>
  </div>

  <!-- Engine Type Filter -->
  <div class="filter-item">
    <h4 onclick="toggleFilter('engine-filter', this)" style="letter-spacing:2px; cursor:pointer;">
      Engine Type <span class="arrow">&#43;</span>
    </h4>
    <div id="engine-filter" class="filter-content">
      <?php
      foreach ($engineTypes as $engineType => $count) {
        echo '<a href="#" class="filter-link" data-filter-type="engine" data-filter-value="' . htmlspecialchars($engineType) . '">' . $engineType . ' (' . $count . ')</a> ';
      }
      ?>
    </div>
  </div>
</div>




                
                   <div class="right-section">
                    <div class="listing-cards">
                        <?php if (!empty($engines)): ?>
                            <?php foreach ($engines as $engine): ?>
                            <?php
$engine_slug = str_replace(' ', '_', $engine['model']); // Create slug like "Rotax_912"
?>



                                <div class="car-card">
                                    <div class="slider" data-current-slide="0">
                    <span class="new-tag" style="font-size: 10px !important;">NEW</span>
                    <div class="favorite-icons">
                        <img src="/assets/pages/img/icons/ribbon.png" width="25px" alt="">
                    </div>
                    <a href="/engines/<?= $engine_slug ?>/<?= $engine['engine_id'] ?>">
                        <div class="slides">
                            <?php 
                            // Fetch all images from the product_images table for the engine
                         $image_stmt = $pdo->prepare("
                                SELECT image_url 
                                FROM product_images 
                                WHERE product_id = :product_id 
                                  AND product_type = 'engine' 
                                ORDER BY sort_order ASC
                            ");

                            $image_stmt->bindParam(':product_id', $engine['engine_id'], PDO::PARAM_INT);
                            $image_stmt->execute();
                            $images = $image_stmt->fetchAll(PDO::FETCH_ASSOC);
                
                            if (!empty($images)): 
                                foreach ($images as $image): ?>
                                    <img src="vendors/<?= htmlspecialchars($image['image_url']); ?>" alt="Engine Image">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <img src="/assets/pages/img/products/default-engine.png" alt="Default Image">
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="arrows">
                        <span class="arrow-left"><img src="/assets/pages/img/icons/left-chevron.png" width="17px" alt=""></span>
                        <span class="arrow-right"><img src="/assets/pages/img/icons/right-arrow-angle.png" width="17px" alt=""></span>
                    </div>
                </div>

                    <div class="car-info" style="text-align: left; font-size: 16px;">
                        <h2 style="margin:20px 0px 30px 15px; font-size: 23px !important;letter-spacing: 1px; color: #000; font-weight: 500;">
                            <?php echo htmlspecialchars($engine['model']); ?>
                        </h2>
                        <p><img src="/assets/pages/img/icons/calendar (2).png" alt="">&nbsp;Year<span style="padding-left: 104px;"> <?php echo $engine['year']; ?></span></p>
                        <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;Total Time<span style="padding-left: 58px;"><?php echo number_format($engine['total_time_hours']); ?> hours</span></p>
                        <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;HR  <span style="padding-left: 106px;"><?php echo number_format($engine['hr']); ?> hours</span></p>
                        <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;CR <span style="padding-left: 108px;"><?php echo number_format($engine['cycles']); ?> cycles</span></p>
                        <p><img src="/assets/pages/img/icons/settings.png" alt="">&nbsp;Condition <span style="padding-left: 60px;"><?php echo htmlspecialchars($engine['condition']); ?></span></p>
                        <h2 style="margin-top:40px;margin-left: 15px; font-size: 30px !important; color: #000; font-weight: 500;">
                            $<?php echo number_format($engine['price']);?>
                        </h2>
                       <div class="button-group">
    <button onclick="window.location.href='/engines/<?= $engine_slug ?>/<?= $engine['engine_id'] ?>';">More Details</button>
</div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No approved engines found.</p>
        <?php endif; ?>
    </div>
</div>




    <!-- BEGIN PRE-FOOTER -->
    <div class="pre-footer" style="margin-top:50px;">
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
    <div id="product-pop-up" style="display: none; width: 500px;">
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
    function resetFilters() {
        // Uncheck all checkboxes
        document.querySelectorAll("input[type='checkbox']").forEach(checkbox => {
            checkbox.checked = false;
        });

        
      

        // Reload the page to show all products
        window.location.reload();
    }

    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }
</script>


     <!-- END PAGE LEVEL JAVASCRIPTS -->
   
     <script>
document.addEventListener("DOMContentLoaded", function () {
    loadManufacturers();
});

// Load Manufacturers from Database
function loadManufacturers() {
    fetch("get_manufacturers.php")
        .then(response => response.json())
        .then(data => {
            let manufacturerDropdown = document.getElementById("manufacturer");
            manufacturerDropdown.innerHTML = '<option value="">Select Manufacturer</option>';
            data.forEach(item => {
                manufacturerDropdown.innerHTML += `<option value="${item.manufacturer}">${item.manufacturer}</option>`;
            });
        })
        .catch(error => console.error("Error loading manufacturers:", error));
}

// Update Models Based on Manufacturer Selection
function updateModels() {
    let manufacturer = document.getElementById("manufacturer").value;
    let modelDropdown = document.getElementById("model");
    modelDropdown.innerHTML = '<option value="">Select Model</option>';

    if (manufacturer) {
        fetch(`get_models.php?manufacturer=${manufacturer}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    modelDropdown.innerHTML += `<option value="${item.engine_model}">${item.engine_model}</option>`;
                });
            })
            .catch(error => console.error("Error loading models:", error));
    }
}

function fetchSuggestions() {
    let searchQuery = document.getElementById("search_query").value.trim();
    let suggestionsBox = document.getElementById("suggestions");

    if (searchQuery.length < 2) {
        suggestionsBox.innerHTML = "";
        return;
    }

    fetch(`get_suggestions.php?query=${searchQuery}`)
        .then(response => response.json())
        .then(data => {
            suggestionsBox.innerHTML = data.map(item => `<div onclick="selectSuggestion('${item}')">${item}</div>`).join("");
        })
        .catch(error => console.error("Error fetching suggestions:", error));
}

// Select Suggestion and Search
function selectSuggestion(value) {
    document.getElementById("search_query").value = value;
    document.getElementById("suggestions").innerHTML = "";
    searchAircraft();
}


// Perform Search
function searchAircraft() {
    let manufacturer = document.getElementById("manufacturer").value;
    let model = document.getElementById("model").value;
    let searchQuery = document.getElementById("search_query").value.trim();
    
    let formData = new FormData();
    if (manufacturer) formData.append("manufacturer", manufacturer);
    if (model) formData.append("model", model);
    if (searchQuery) formData.append("search_query", searchQuery);

    fetch("search_engines.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        let listingCards = document.querySelector(".listing-cards");
        listingCards.innerHTML = ""; // Clear previous listings completely

        if (data.length === 0) {
            listingCards.innerHTML = "<p>No engines found.</p>";
            return;
        }

       data.forEach(engine => {
    let images = engine.images || [];
    let imagesHTML = images.length
        ? images.map(image => `<img src="vendors/${image}" alt="Engine Image">`).join("")
        : `<img src="/assets/pages/img/products/default-engine.png" alt="Default Image">`;

    let sliderDots = images.length
        ? images.map(() => `<span class="dot"></span>`).join("")
        : "";

    let engineHTML = `
        <div class="car-card">
            <div class="slider" data-current-slide="0">
                <span class="new-tag" style="font-size: 10px !important;">NEW</span>
                <div class="favorite-icons">
                    <img src="/assets/pages/img/icons/ribbon.png" width="25px" alt="">
                </div>
                <a href="engine_details.php?id=${engine.engine_id}">
                    <div class="slides">${imagesHTML}</div>
                </a>
                <div class="arrows">
                    <span class="arrow-left"><img src="/assets/pages/img/icons/left-chevron.png" width="17px" alt=""></span>
                    <span class="arrow-right"><img src="/assets/pages/img/icons/right-arrow-angle.png" width="17px" alt=""></span>
                </div>
                <div class="slider-dots">${sliderDots}</div>
            </div>
            <div class="car-info" style="text-align: left; font-size: 16px;">
                <h2 style="margin:20px 0px 30px 15px; font-size: 23px !important; letter-spacing: 1px; color: #000; font-weight: 500;">
                    ${engine.engine_type}
                </h2>
                <p><img src="/assets/pages/img/icons/calendar (2).png" alt="">&nbsp;Year<span style="padding-left: 104px;"> ${engine.year}</span></p>
                <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;Total Time<span style="padding-left: 58px;">${Number(engine.total_time_hours).toLocaleString()} hours</span></p>
                <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;HR  <span style="padding-left: 116px;">${Number(engine.hr).toLocaleString()} hours</span></p>
                <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;CR <span style="padding-left: 118px;">${Number(engine.cycles).toLocaleString()} cycles</span></p>
                <p><img src="/assets/pages/img/icons/settings.png" alt="">&nbsp;Condition <span style="padding-left: 60px;">${engine.condition}</span></p>
                <h2 style="margin-top:40px;margin-left: 15px; font-size: 30px !important; color: #000; font-weight: 500;">
                    $${Number(engine.price).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                </h2>
                <div class="button-group">
                    <button onclick="window.location.href='engine_details.php?id=${engine.engine_id}';">More Details</button>
                </div>
            </div>
        </div>`;

    listingCards.innerHTML += engineHTML;
});

initSliders(); // Initialize slider functionality
 // Initialize slider functionality
    })
    .catch(error => console.error("Error fetching search results:", error));
}






</script>
 <script>
 // Function to handle filter link click
document.querySelectorAll('.filter-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior

        let filterType = this.getAttribute('data-filter-type');
        let filterValue = this.getAttribute('data-filter-value');
        
        // Update the UI to show the selected filter
        updateSelectedFilters(filterType, filterValue);

        // Apply filters
        applyFilters();
    });
});

function updateSelectedFilters(filterType, filterValue) {
    let selectedFiltersContainer = document.getElementById('selected-filters');
    let existingFilter = document.querySelector(`.selected-filter[data-filter-type="${filterType}"][data-filter-value="${filterValue}"]`);

    if (!existingFilter) {
        // Create a new selected filter element
        let filterItem = document.createElement('div');
        filterItem.classList.add('selected-filter');
        filterItem.setAttribute('data-filter-type', filterType);
        filterItem.setAttribute('data-filter-value', filterValue);
        filterItem.innerHTML = `${filterValue} <a href="#" class="remove-filter" onclick="removeFilter(event, '${filterType}', '${filterValue}')">✖</a>`;
        selectedFiltersContainer.appendChild(filterItem);
        selectedFiltersContainer.style.display = 'block'; // Show selected filters

    }
}

function removeFilter(event, filterType, filterValue) {
    event.preventDefault();
    let filterItem = document.querySelector(`.selected-filter[data-filter-type="${filterType}"][data-filter-value="${filterValue}"]`);
    filterItem.remove();

    // Reapply the filters after removing one
    applyFilters();
}

function applyFilters() {
    let selectedConditions = [];
    let selectedLocations = [];
    let selectedManufacturers = [];
    let selectedEngineTypes = [];

    // Collect selected filters
    document.querySelectorAll('.selected-filter').forEach(filter => {
        let filterType = filter.getAttribute('data-filter-type');
        let filterValue = filter.getAttribute('data-filter-value');
        
        if (filterType === 'condition') {
            selectedConditions.push(filterValue);
        } else if (filterType === 'location') {
            selectedLocations.push(filterValue);
        } else if (filterType === 'manufacturer') {
            selectedManufacturers.push(filterValue);
        } else if (filterType === 'engine') {
            selectedEngineTypes.push(filterValue);
        }
    });

    let formData = new FormData();
    formData.append("conditions", JSON.stringify(selectedConditions));
    formData.append("locations", JSON.stringify(selectedLocations));
    formData.append("manufacturers", JSON.stringify(selectedManufacturers));
    formData.append("engineTypes", JSON.stringify(selectedEngineTypes));

    // Send the data to the server
    fetch("filter_engines.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        let listingCards = document.querySelector(".listing-cards");
        listingCards.innerHTML = ""; // Clear previous listings

        if (data.length === 0) {
            listingCards.innerHTML = "<p>No engines found.</p>";
            return;
        }

        data.forEach(engine => {
            let images = engine.images ? engine.images.split(",") : [];
            let imagesHTML = images.length
                ? images.map(image => `<img src="vendors/${image}" alt="Engine Image">`).join("")
                : `<img src="/assets/pages/img/products/default-engine.png" alt="Default Image">`;

            let sliderDots = images.length
                ? images.map(() => `<span class="dot"></span>`).join("")
                : "";

            let engineHTML = `
                <div class="car-card">
                    <div class="slider" data-current-slide="0">
                        <span class="new-tag" style="font-size: 10px !important;">NEW</span>
                        <div class="favorite-icons">
                            <img src="/assets/pages/img/icons/ribbon.png" width="25px" alt="">
                        </div>
                        <a href="engine_details.php?id=${engine.engine_id}">
                            <div class="slides">${imagesHTML}</div>
                        </a>
                        <div class="arrows">
                            <span class="arrow-left"><img src="/assets/pages/img/icons/left-chevron.png" width="17px" alt=""></span>
                            <span class="arrow-right"><img src="/assets/pages/img/icons/right-arrow-angle.png" width="17px" alt=""></span>
                        </div>
                        <div class="slider-dots">${sliderDots}</div>
                    </div>
                    <div class="car-info" style="text-align: left; font-size: 16px;">
                        <h2 style="margin:20px 0px 30px 15px; font-size: 23px !important; letter-spacing: 1px; color: #000; font-weight: 500;">
                            ${engine.engine_type}
                        </h2>
                        <p><img src="/assets/pages/img/icons/calendar (2).png" alt="">&nbsp;Year<span style="padding-left: 104px;"> ${engine.year}</span></p>
                        <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;Total Time<span style="padding-left: 58px;">${Number(engine.total_time_hours).toLocaleString()} hours</span></p>
                        <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;HR  <span style="padding-left: 116px;">${Number(engine.hr).toLocaleString()} hours</span></p>
                        <p><img src="/assets/pages/img/icons/time-management (1).png" alt="">&nbsp;CR <span style="padding-left: 118px;">${Number(engine.cycles).toLocaleString()} cycles</span></p>
                        <p><img src="/assets/pages/img/icons/settings.png" alt="">&nbsp;Condition <span style="padding-left: 60px;">${engine.condition}</span></p>
                        <h2 style="margin-top:40px;margin-left: 15px; font-size: 30px !important; color: #000; font-weight: 500;">
                            $${Number(engine.price).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                        </h2>
                        <div class="button-group">
                            <button onclick="window.location.href='engine_details.php?id=${engine.engine_id}';">More Details</button>
                        </div>
                    </div>
                </div>`;

            listingCards.innerHTML += engineHTML;
        });

        initSliders(); // Initialize slider functionality
    })
    .catch(error => console.error("Error fetching search results:", error));
}

    </script>

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
        function initSliders() {
    document.querySelectorAll(".slider").forEach((slider) => {
        let slides = slider.querySelectorAll(".slides img");
        let dots = slider.querySelectorAll(".slider-dots .dot");
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? "block" : "none";
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle("active", i === index);
            });
        }

        slider.querySelector(".arrow-left").addEventListener("click", () => {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });

        slider.querySelector(".arrow-right").addEventListener("click", () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });

        dots.forEach((dot, index) => {
            dot.addEventListener("click", () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        showSlide(currentSlide);
    });
}

    </script>
       <script>
        document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".clear-filters-btn").addEventListener("click", function () {
        // Clear all filters (assuming they are stored in the URL parameters)
        const url = new URL(window.location.href);
        url.search = ""; // Remove all query parameters
        window.location.href = "/engine"; // Redirect to the parts page
    });
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