<?php
require 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
 <title>Services</title>

<!-- Responsive and Compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- SEO Meta -->
<meta name="description" content="Explore top-rated aviation services on Flying411. From certified flight instructors to avionics shops and maintenance, find everything you need for your aircraft.">
<meta name="keywords" content="aviation services, flight instructors, flight schools, engine shops, avionics, maintenance shops, local aircraft mechanics, Flying411 services, aviation support">
<meta name="author" content="Flying411">

<!-- Open Graph Meta (for Social Sharing) -->
<meta property="og:site_name" content="Flying411">
<meta property="og:title" content="Find Aviation Services - Flight Instructors, Maintenance, and More | Flying411">
<meta property="og:description" content="Discover trusted aviation service providers including flight schools, instructors, and aircraft maintenance on Flying411.">
<meta property="og:type" content="website">
<meta property="og:image" content="https://flying411.com/assets/corporate/img/Hangar-2-4-White-Final-1.png"> <!-- Replace with actual image -->
<meta property="og:url" content="https://flying411.com/services.php">


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
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->  
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
            margin: auto;
            padding: 20px 0;
        }

        /* Filter Section */
        .filter-section {
            width: 300px;
            background-color: #fff;
            border: 1px solid #ddd;
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
       font-family: "EB Garamond", serif!important;
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
      color: black !important;
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
    .slides {
      display: flex !important;
      width: 300% !important; /* If 3 slides total, can be 300% */
      transition: transform 0.4s ease !important;
  height: 100% !important
  ;  }
    .slides img {
      width: 33.56% !important;
      height: 100% !important;
      object-fit: cover !important;
    }
    .header .header-navigation ul li a{
        color:white !important;
             font-family: "EB Garamond", serif !important;
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
    @media (max-width: 990px) {
      .car-card {
        width: 100% !important;
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
            background: url('/assets/pages/img/products/services.jpg') center center/cover no-repeat;
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
            border-radius: 30px !important;
            
        }

        .search-bar select {
            flex: 1;
    border: 1px solid white;
    color: black;
    border-radius: 31px;
    max-width: 522px;
    appearance: none;
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
                width: 80%;
            }
        }
.filter-section {
    width: 250px;
    border: 1px solid #ddd;
    padding: 15px;
    background: #fff;
   
}

.filter-item h4 {
    font-size: 14px;
    font-weight: 500;
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
                width: 100% !important;
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
    display: none;
    padding: 10px;
    /*max-height: 200px;*/
    overflow-y: auto;
    border: 1px solid #ddd;
    background: #fff;
}

.filter-content label {
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
.selected-filters span:hover{
    cursor: pointer;
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
.breed-list {
            flex: 1;
            min-width: 250px;
            padding-right: 20px;
        }
        .breed-list h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .breed-list ul {
            list-style: none;
            padding: 0;
        }
        .breed-list li {
            font-size: 18px;
            margin-bottom: 15px;
        }
                .breed-list li a{
                    color: #424d5c;
                }
        .map-container {
            flex: 2;
            min-width: 300px;
        }
        iframe {
            width: 100%;
            height: 350px;
            border: none;
        }
        .upload-container {
            margin-top: 20px;
            text-align: center;
            width: 100%;
        }
        @media (max-width: 768px) {
            .container {
                align-items: center;
            }
            .breed-list, .map-container {
                width: 100%;
                text-align: center;
            }
            .search-bar select{
                margin:auto;
                width:90%;
            }
        }
         .filter-bar {
            display: flex;
            gap: 10px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .filter-bar select, .filter-bar input, .filter-bar button {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
                width: 40%;
    padding: 14px
        }
        .service-grid {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            justify-content: space-between;
            row-gap: 30px;
            width: 100%;
        }
        .service-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            font-size: 14px;
            width:30% !important;
        }
        .service-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .service-card .content {
            padding: 15px;
        }
        .service-card h3 {
            margin: 10px 0;
            font-size: 18px;
        }
        .rating {
            color: gold;
        }
        .contact-info {
            font-size: 14px;
            margin: 10px 0;
        }
        .inquiry-btn {
            display: block;
            text-align: center;
            background: white;
            color: black;
            padding: 8px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            border:1px solid black;
        }
         .inquiry-btn:hover{
             background-color: lightgray;
             color: white;
         }
         
         .suggestions-box {
    position: absolute;
    background: white;
   
    max-width: 300px;
    z-index: 1000;
    color: black;
    top: 53px;
    width: 29%;
}
.suggestion-item {
    padding: 13px;
    font-size: 14px;
    cursor: pointer;
}
.suggestion-item:hover {
    background: #f0f0f0;
}


 .map-container {
            width: 100%;
            height: 500px;
            position: relative;
        }
        #map {
            width: 100%;
            height: 80%;
        }
        .search-container {
            margin-bottom: 10px;
        }
        
        
        
        @media (min-width: 1200px) {
    .container, .container-lg, .container-md, .container-sm {
        max-width: 1225px !important;
    }
}
@media (min-width: 1025px) {
    .container, .container-lg, .container-md, .container-sm {
        max-width: 1150px !important;
    }
    .header .top-cart-block {
    margin-left: 5px !important;
}
.site-logo img {
    border-radius: 50% !important;
    margin-right: 28px !important;
}

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
                width: 80%;
            }
        }
        
         @media (max-width: 560px) {
     
    .header-navigation ul li a{
      color: black !important;
    }
    .header-navigation ul li a:hover{
      background-color: transparent;
      color: #555;
    }
    .search-container input{
        width:190px !important;
    }
    }
    .headers {
            position: relative;
            width: 100%;
            height: 80vh;
            /*background: url('/assets/pages/img/products/aircraft.jpg') center center/cover no-repeat;*/
            background: url('/assets/pages/img/products/aircraft1.jpg') center center/cover no-repeat;
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

    </style>
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce">
  <!-- BEGIN TOP BAR -->

  <!-- END TOP BAR -->

  <!-- BEGIN HEADER -->
  <div class="header" style="position: absolute; width:100%">
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
    <?php
session_start(); // Start the session to check login status
?>
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
    <h1>WELCOME TO AVIATION SERVICES</h1>
    <p style="font-size: 25px; color: white;">Find Certified Flight Instructors, Schools, and More</p>
   <div class="search-bar">
    <!-- Service Type Filter (Dynamically Loaded) -->
  <select name="service_type" id="service_type">
    <option value="">All Service Types</option>
    <option data-service="Flight Instructor">Flight Instructor</option>
    <option data-service="Flight School">Flight School</option>
    <option data-service="Engine Shop">Engine Shop</option>
    <option data-service="Avionics Shop">Avionics Shop</option>
    <option data-service="Maintenance Shop">Maintenance Shop</option>
    <option data-service="Local Mechanic">Local Mechanic</option>
</select>


    <!--<input type="text" name="manufacturer" id="manufacturer" placeholder="Search by Service Name ...">-->
    <!--<div id="suggestions" class="suggestions-box"></div>-->
    <!--<button type="button" onclick="searchParts()">Search</button>-->
</div>

    </div>
</div>



<div class="container" style="margin-top:50px;">
    <div class="breed-list">
       
        <h2>Popular Services </h2>
       
        <ul>
            <li><a href="#" data-service="Flight Instructor">Flight Instructor</a></li>
            <li><a href="#" data-service="Flight School">Flight School</a></li>
            <li><a href="#" data-service="Engine Shop">Engine Shop</a></li>
            <li><a href="#" data-service="Avionics Shop">Avionics Shop</a></li>
            <li><a href="#" data-service="Maintenance Shop">Maintenance Shops</a></li>
            <li><a href="#" data-service="Local Mechanic">Local Mechanic</a></li>
        </ul>
    </div>
    
    <div class="map-container">
        <div class="search-container">
        <input id="searchBox" type="text" placeholder="Search for a location" style="width: 300px; padding: 8px; border:1px solid black">
        <button onclick="searchLocation()" style="padding:8px 12px; background-color:#e30b17; color:white; border:none">Search</button>
        <a href="" class="filterbtn" style="background-color:white; padding:8px 12px; color:black; border:1px solid black; float:right; border-radius:4px;">Clear Filters</a>
    </div>
        <div id="map"></div>
    </div>
</div>
 <div class="container" style="margin-top: 30px;">
       
        <div id="serviceGrid" class="service-grid">
            <!-- Cards will be injected here dynamically -->
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
function toggleFilter(filterId, element) {
    let filterContent = document.getElementById(filterId);
    let arrow = element.querySelector('.arrow');
    
    if (filterContent.style.display === "none" || filterContent.style.display === "") {
        filterContent.style.display = "block";
        arrow.innerHTML = "&#9652;";
    } else {
        filterContent.style.display = "none";
        arrow.innerHTML = "&#9662;";
    }
}


</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".clear-filters-btn").addEventListener("click", function () {
        // Clear all filters (assuming they are stored in the URL parameters)
        const url = new URL(window.location.href);
        url.search = ""; // Remove all query parameters
        window.location.href = "/services"; // Redirect to the parts page
    });
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const serviceTypeSelect = document.getElementById("service_type");
    const serviceGrid = document.getElementById("serviceGrid");
    const serviceLinks = document.querySelectorAll(".service-link");

    let map;
    let markers = [];
    const geocoder = new google.maps.Geocoder(); // Create geocoder ONCE

    // Initialize Google Map
    function initMap() {
        const defaultLocation = { lat: 39.8283, lng: -98.5795 }; // Center of USA
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 4
        });

        // Only fetch services after map is ready
        fetchServices();
    }

    // Fetch services based on selected type or fetch all
    async function fetchServices(type = "") {
        try {
            const response = await fetch(`fetch_filter_services.php?service_type=${encodeURIComponent(type)}`);
            const services = await response.json();

            displayServices(services);
            updateMapMarkers(services);
        } catch (error) {
            console.error("Error fetching services:", error);
        }
    }

    // Display services in the card grid
    function displayServices(services) {
        serviceGrid.innerHTML = "";

        if (!Array.isArray(services) || services.length === 0) {
            serviceGrid.innerHTML = "<p>No matching services found.</p>";
            return;
        }

        services.forEach(service => {
            let photo = "default.jpg";
            try {
                const parsedPhotos = JSON.parse(service.photos);
                if (Array.isArray(parsedPhotos) && parsedPhotos.length > 0) {
                    photo = parsedPhotos[0];
                }
            } catch (e) {
                console.error("Error parsing photos:", e);
            }

            serviceGrid.innerHTML += `
                <div class="service-card">
                   <a href="services_details.php?id=${service.id}">
            <img src="vendors/uploads/${photos}" alt="Service Image">
        </a>
                    <div class="content">
                        <h3>${service.business_name || ''}</h3>
                        <div class="rating">★★★★★</div>
                        <div>${service.ratings || ''}</div>
                        <div>Location: ${service.country || ''}</div>
                        <div class="contact-info">
                            ${service.phone_number ? `<p>Phone: ${service.phone_number}</p>` : ''}
                            ${service.email ? `<p>Email: <a href="mailto:${service.email}">${service.email}</a></p>` : ''}
                        </div>
                        <div>Website: ${service.website || ''}</div>
                         <a href="services_details.php?id=${service.id}" class="inquiry-btn">Inquiry</a>
                    </div>
                </div>
            `;
        });
    }

    // Update map markers based on services
    function updateMapMarkers(servicesList) {
        clearMarkers(); // Always clear old markers first

        if (!servicesList || servicesList.length === 0) return;

        servicesList.forEach(service => {
            const address = service.country?.trim();
            if (address) {
                geocoder.geocode({ address: address }, (results, status) => {
                    if (status === "OK" && results[0]) {
                        const marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: service.business_name || "Service Location"
                        });
                        markers.push(marker);
                    } else {
                        console.error(`Geocode failed for "${address}" - Status:`, status);
                    }
                });
            } else {
                console.warn("No address available for service:", service);
            }
        });
    }

    // Clear existing markers
    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        markers = [];
    }

    // Handle service type dropdown change
    serviceTypeSelect.addEventListener("change", function () {
        const selectedType = this.value;
        fetchServices(selectedType);
    });

    // Handle service links click
    serviceLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const selectedType = this.dataset.service;
            fetchServices(selectedType);
        });
    });

    // Attach initMap to window so Google Maps API can call it
    window.initMap = initMap;
});
</script>





<script>
    document.addEventListener("DOMContentLoaded", function () {
    const manufacturerInput = document.getElementById("manufacturer");
    const suggestionsBox = document.getElementById("suggestions");
    const serviceGrid = document.getElementById("serviceGrid");

   
   
    // Fetch services when search button is clicked
    async function searchParts() {
        const serviceType = manufacturerInput.value.trim();

        if (serviceType === "") {
            alert("Please enter a service type.");
            return;
        }

        try {
            const response = await fetch(`fetch_filtered_services.php?service_type=${encodeURIComponent(serviceType)}`);
            const services = await response.json();

            displayServices(services);
        } catch (error) {
            console.error("Error fetching services:", error);
        }
    }

    // Display services in the grid
    function displayServices(services) {
        serviceGrid.innerHTML = "";

        if (services.length === 0) {
            serviceGrid.innerHTML = "<p>No matching services found.</p>";
            return;
        }

        services.forEach(service => {
            serviceGrid.innerHTML += `
                <div class="service-card" >
                     <a href="services_details.php?id=${service.id}">
            <img src="vendors/uploads/${photos}" alt="Service Image">
        </a>

                        <div class="content">
                             <h3>${service.business_name ? service.business_name : vendors.busniness_name}</h3>
                            <div class="rating">★★★★★ </div>
                            <div> ${service.ratings}</div>
                            <div>Location :  ${service.country}</div>

                            <div class="contact-info">
                               ${service.phone_number ? `<p>Phone: <a href="tel:${service.phone_number}" style="text-decoration: none;">${service.phone_number}</a></p>` : ''}
                            ${service.email ? `<p>Email: <a href="mailto:${service.email}">${service.email}</a></p>` : ''}
                            </div>
                            <div>Website :  ${service.website}</div>
                             <a href="services_details.php?id=${service.id}" class="inquiry-btn">Inquiry</a>
                        </div>
                    </div>
            `;
        });
    }

    // Attach event listener to the search button
    window.searchParts = searchParts;
});

</script>


<script>
    let map, autocomplete;

    async function initMap() {
        const defaultLocation = { lat: 39.8283, lng: -98.5795 }; // Center of USA
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 4
        });

        if (searchBox) {
            autocomplete = new google.maps.places.Autocomplete(searchBox);
            autocomplete.addListener("place_changed", searchLocation);
        } else {
            console.error("Search input not found.");
        }

        // Fetch and add service markers
        fetchAndAddServiceMarkers();
    }

    function searchLocation() {
        const place = autocomplete.getPlace();
        if (!place || !place.geometry) {
            alert("Please select a valid location.");
            return;
        }
        map.setCenter(place.geometry.location);
        map.setZoom(12);
    }

    async function fetchAndAddServiceMarkers() {
        try {
            const response = await fetch("fetch_services.php");
            const services = await response.json();

            if (services.error) {
                console.error("Error fetching services:", services.error);
                return;
            }

            const geocoder = new google.maps.Geocoder();

            services.forEach(service => {
                if (service.country) {
                    geocoder.geocode({ address: service.country }, (results, status) => {
                        if (status === "OK" && results[0]) {
                            const marker = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location,
                                title: service.business_name || "Service Location"
                            });
                        } else {
                            console.error("Geocode was not successful for the following reason: " + status);
                        }
                    });
                }
            });
        } catch (error) {
            console.error("Error fetching services:", error);
        }
    }

    window.onload = initMap;
</script>


    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmlHqr1dCDcSciN-_94-i3jUg5P-48j60&libraries=places&callback=initMap"></script>
    
    <script>
      document.addEventListener("DOMContentLoaded", function () {
    const serviceGrid = document.getElementById("serviceGrid");
    const searchBox = document.getElementById("searchBox");

    function fetchServicesByLocation(location) {
        if (!location) {
            serviceGrid.innerHTML = "<p>Please enter a location.</p>";
            return;
        }

        fetch("fetch_services_by_location.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "location=" + encodeURIComponent(location)
        })
        .then(response => response.text())
        .then(textResponse => {
            console.log("Raw PHP Response:", textResponse);
            return JSON.parse(textResponse);
        })
        .then(services => displayServices(services))
        .catch(error => console.error("Error fetching services:", error));
    }

    function displayServices(services) {
        serviceGrid.innerHTML = "";
        if (!Array.isArray(services) || services.length === 0) {
            serviceGrid.innerHTML = "<p>No matching services found.</p>";
            return;
        }

        services.forEach(service => {
            let photos = "default.jpg"; // Default image
            try {
                let parsedPhotos = JSON.parse(service.photos);
                if (Array.isArray(parsedPhotos) && parsedPhotos.length > 0) {
                    photos = parsedPhotos[0]; // Use first photo
                }
            } catch (e) {
                console.error("Error parsing photos:", e);
            }

            serviceGrid.innerHTML += `
                <div class="service-card">
                     <a href="services_details.php?id=${service.id}">
            <img src="vendors/uploads/${photos}" alt="Service Image">
        </a>

                        <div class="content">
                            <h3>${service.business_name ? service.business_name : vendors.busniness_name}</h3>
                            <div class="rating">★★★★★ </div>
                            <div> ${service.ratings}</div>
                            <div>Location :  ${service.country}</div>

                            <div class="contact-info">
                                ${service.phone_number ? `<p>Phone: <a href="tel:${service.phone_number}" style="text-decoration: none;">${service.phone_number}</a></p>` : ''}

                            ${service.email ? `<p>Email: <a href="mailto:${service.email}">${service.email}</a></p>` : ''}
                            </div>
                            <div>Website :  ${service.website}</div>
                             <a href="services_details.php?id=${service.id}" class="inquiry-btn">Inquiry</a>
                        </div>
                    </div>
            `;
        });
    }

    // Automatically fetch results as user types (with a delay to optimize performance)
    let typingTimer;
    const typingDelay = 100; // Delay in milliseconds

    searchBox.addEventListener("input", function () {
        clearTimeout(typingTimer);
        let location = searchBox.value.trim();

        // Delay fetching to reduce excessive API calls
        typingTimer = setTimeout(() => {
            fetchServicesByLocation(location);
        }, typingDelay);
    });
});

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const clearFilterBtn = document.querySelector(".filterbtn");

    clearFilterBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default link behavior
        location.reload(); // Refresh the page
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
    async function fetchServices() {
        try {
            const response = await fetch("fetch_services.php");
            const services = await response.json();

            const serviceGrid = document.getElementById("serviceGrid");
            serviceGrid.innerHTML = "";

            if (services.error) {
                serviceGrid.innerHTML = `<p>Error: ${services.error}</p>`;
                return;
            }

            services.forEach(service => {
                serviceGrid.innerHTML += `
                     <div class="service-card">
                      
<a href="services_details.php?id=${service.id}">
             <img src="vendors/uploads/${service.photo}" alt="Service Image">
        </a>
                        <div class="content">
                            <h3>${service.business_name ? service.business_name : vendors.busniness_name}</h3>
                            <div class="rating">★★★★★ </div>
                            <div> ${service.ratings}</div>
                            <div>Location :  ${service.country}</div>

                            <div class="contact-info">
                              ${service.phone_number ? `<p>Phone: <a href="tel:${service.phone_number}" style="text-decoration: none;">${service.phone_number}</a></p>` : ''}

                            ${service.email ? `<p>Email: <a href="mailto:${service.email}">${service.email}</a></p>` : ''}
                            </div>
                            <div>Website :  ${service.website}</div>
                             <a href="services_details.php?id=${service.id}" class="inquiry-btn">Inquiry</a>
                        </div>
                    </div>
                `;
            });
        } catch (error) {
            console.error("Error fetching services:", error);
        }
    }

    window.onload = fetchServices;
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const serviceLinks = document.querySelectorAll(".breed-list ul li a");
    const serviceGrid = document.getElementById("serviceGrid");

    let map;
    let markers = [];

    // Initialize Google Map
    async function initMap() {
        const defaultLocation = { lat: 39.8283, lng: -98.5795 }; // Center of USA
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 4
        });

        // Fetch and add all services on initial load if no filter is applied
        fetchAndAddAllServices();
    }

    // Fetch all services without filter (for main services page)
    async function fetchAndAddAllServices() {
        try {
            const response = await fetch("fetch_services.php");
            const services = await response.json();

            // Display the services in the grid and update map markers
            displayServices(services);
            updateMapMarkers(services);
        } catch (error) {
            console.error("Error fetching services:", error);
        }
    }

    // Fetch filtered services based on selected type
    function fetchFilteredServices(serviceType) {
        if (!serviceType) {
            serviceGrid.innerHTML = "<p>No service selected.</p>";
            clearMarkers();
            return;
        }

        fetch("fetch_checkbox_services.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "services=" + encodeURIComponent(JSON.stringify([serviceType]))
        })
        .then(response => response.text())
        .then(textResponse => {
            console.log("Raw PHP Response:", textResponse);
            return JSON.parse(textResponse);
        })
        .then(services => {
            displayServices(services);
            updateMapMarkers(services);
        })
        .catch(error => console.error("Error fetching services:", error));
    }

    // Display the services in the grid
    function displayServices(services) {
        serviceGrid.innerHTML = "";
        if (!Array.isArray(services) || services.length === 0) {
            serviceGrid.innerHTML = "<p>No matching services found.</p>";
            return;
        }

        services.forEach(service => {
            let photos = "default.jpg"; // Default image
            try {
                let parsedPhotos = JSON.parse(service.photos);
                if (Array.isArray(parsedPhotos) && parsedPhotos.length > 0) {
                    photos = parsedPhotos[0]; // Use first photo
                }
            } catch (e) {
                console.error("Error parsing photos:", e);
            }

            serviceGrid.innerHTML += `
               <div class="service-card">
                     <a href="services_details.php?id=${service.id}">
            <img src="vendors/uploads/${photos}" alt="Service Image">
        </a>
                        <div class="content">
                            <h3>${service.business_name || ''}</h3>
                            <div class="rating">★★★★★</div>
                            <div>${service.ratings || ''}</div>
                            <div>Location: ${service.country || ''}</div>
                            <div class="contact-info">
                               ${service.phone_number ? `<p>Phone: <a href="tel:${service.phone_number}" style="text-decoration: none;">${service.phone_number}</a></p>` : ''}

                                ${service.email ? `<p>Email: <a href="mailto:${service.email}">${service.email}</a></p>` : ''}
                            </div>
                            <div>Website: ${service.website || ''}</div>
                             <a href="services_details.php?id=${service.id}" class="inquiry-btn">Inquiry</a>
                        </div>
                    </div>
            `;
        });
    }

    // Update map markers based on the fetched services list
    function updateMapMarkers(servicesList) {
        clearMarkers();
        const geocoder = new google.maps.Geocoder();

        servicesList.forEach(service => {
            if (service.country) {
                geocoder.geocode({ address: service.country }, (results, status) => {
                    if (status === "OK" && results[0]) {
                        const marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: service.business_name || "Service Location"
                        });
                        markers.push(marker);
                    } else {
                        console.error("Geocode failed: " + status);
                    }
                });
            }
        });
    }

    // Clear any existing markers on the map
    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        markers = [];
    }

    // Filter services based on the link clicked
    serviceLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            let serviceType = this.dataset.service;
            fetchFilteredServices(serviceType);
        });
    });

    // Initialize the map
    window.initMap = initMap;
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const serviceLinks = document.querySelectorAll(".breed-list ul li a");
    const serviceGrid = document.getElementById("serviceGrid");
    const serviceTypeSelect = document.getElementById("service_type");

    let map;
    let markers = [];

    // Initialize Google Map
    async function initMap() {
        const defaultLocation = { lat: 39.8283, lng: -98.5795 }; // Center of USA
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 4
        });

        // Fetch and add all services on initial load
        fetchAndAddAllServices();
    }

    // Fetch all services without filter
    async function fetchAndAddAllServices() {
        try {
            const response = await fetch("fetch_services.php");
            const services = await response.json();
            displayServices(services);
            updateMapMarkers(services);
        } catch (error) {
            console.error("Error fetching services:", error);
        }
    }

    // Fetch filtered services based on selected type
    function fetchFilteredServices(serviceType) {
        if (!serviceType) {
            fetchAndAddAllServices();
            return;
        }

        fetch("fetch_checkbox_services.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "services=" + encodeURIComponent(JSON.stringify([serviceType]))
        })
        .then(response => response.text())
        .then(textResponse => {
            console.log("Raw PHP Response:", textResponse);
            return JSON.parse(textResponse);
        })
        .then(services => {
            displayServices(services);
            updateMapMarkers(services);
        })
        .catch(error => console.error("Error fetching services:", error));
    }

    // Display the services in the grid
    function displayServices(services) {
        serviceGrid.innerHTML = "";
        if (!Array.isArray(services) || services.length === 0) {
            serviceGrid.innerHTML = "<p>No matching services found.</p>";
            return;
        }

        services.forEach(service => {
            let photos = "default.jpg"; // Default image
            try {
                let parsedPhotos = JSON.parse(service.photos);
                if (Array.isArray(parsedPhotos) && parsedPhotos.length > 0) {
                    photos = parsedPhotos[0]; // Use first photo
                }
            } catch (e) {
                console.error("Error parsing photos:", e);
            }

            serviceGrid.innerHTML += `
                <div class="service-card">
                   <a href="services_details.php?id=${service.id}">
            <img src="vendors/uploads/${photos}" alt="Service Image">
        </a>
                    <div class="content">
                        <h3>${service.business_name || ''}</h3>
                        <div class="rating">★★★★★</div>
                        <div>${service.ratings || ''}</div>
                        <div>Location: ${service.country || ''}</div>
                        <div class="contact-info">
                          ${service.phone_number ? `<p>Phone: <a href="tel:${service.phone_number}" style="text-decoration: none;">${service.phone_number}</a></p>` : ''}

                            ${service.email ? `<p>Email: <a href="mailto:${service.email}">${service.email}</a></p>` : ''}
                        </div>
                        <div>Website: ${service.website ? `<a href="${service.website}" target="_blank">${service.website}</a>` : ''}</div>
                        <a href="services_details.php?id=${service.id}" class="inquiry-btn">Inquiry</a>
                    </div>
                </div>
            `;
        });
    }

    // Update map markers
    function updateMapMarkers(servicesList) {
        clearMarkers();
        const geocoder = new google.maps.Geocoder();

        servicesList.forEach(service => {
            if (service.country) {
                geocoder.geocode({ address: service.country }, (results, status) => {
                    if (status === "OK" && results[0]) {
                        const marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: service.business_name || "Service Location"
                        });
                        markers.push(marker);
                    } else {
                        console.error("Geocode failed: " + status);
                    }
                });
            }
        });
    }

    // Clear existing markers from map
    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        markers = [];
    }

    // Link click filter
    serviceLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const serviceType = this.dataset.service;
            fetchFilteredServices(serviceType);
        });
    });

    // Dropdown change filter
    serviceTypeSelect.addEventListener("change", function () {
        const selectedOption = serviceTypeSelect.options[serviceTypeSelect.selectedIndex];
        const selectedService = selectedOption.getAttribute("data-service") || "";

        if (selectedService) {
            fetchFilteredServices(selectedService);
        } else {
            fetchAndAddAllServices();
        }
    });

    // Initialize map
    window.initMap = initMap;
});
</script>


</body>
<!-- END BODY -->
</html>