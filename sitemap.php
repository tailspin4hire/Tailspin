<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/xml; charset=utf-8");

// Include your database connection
require_once 'config.php'; // This file should define $pdo as the PDO connection

$base_url = "https://flying411.com";

// Start XML output
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

// Static pages
$static_pages = [
    '',
    'parts',
    'engine',
    'aircraft',
    'services',
    'contacts'
];

foreach ($static_pages as $page) {
    echo "<url>\n";
    echo "<loc>$base_url/$page</loc>\n";
    echo "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
    echo "<changefreq>weekly</changefreq>\n";
    echo "<priority>0.8</priority>\n";
    echo "</url>\n";
}

// Dynamic Part Details
$parts = $pdo->query("SELECT part_id FROM parts WHERE deleted_at IS NULL");
if ($parts) {
    while ($row = $parts->fetch(PDO::FETCH_ASSOC)) {
        echo "<url>\n";
        echo "<loc>$base_url/parts_details?part_id=" . $row['part_id'] . "</loc>\n";
        echo "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
        echo "<changefreq>weekly</changefreq>\n";
        echo "<priority>0.7</priority>\n";
        echo "</url>\n";
    }
}

// Dynamic Engine Pages
$engines = $pdo->query("SELECT model, engine_id FROM engines WHERE deleted_at IS NULL");
if ($engines) {
    while ($row = $engines->fetch(PDO::FETCH_ASSOC)) {
        echo "<url>\n";
        echo "<loc>$base_url/engines/" . urlencode($row['model']) . "/" . $row['engine_id'] . "</loc>\n";
        echo "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
        echo "<changefreq>weekly</changefreq>\n";
        echo "<priority>0.7</priority>\n";
        echo "</url>\n";
    }
}

// Dynamic Aircraft Pages
$aircrafts = $pdo->query("SELECT model, aircraft_id FROM aircrafts WHERE deleted_at IS NULL");
if ($aircrafts) {
    while ($row = $aircrafts->fetch(PDO::FETCH_ASSOC)) {
        echo "<url>\n";
        echo "<loc>$base_url/" . urlencode($row['model']) . "/" . $row['aircraft_id'] . "</loc>\n";
        echo "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
        echo "<changefreq>weekly</changefreq>\n";
        echo "<priority>0.7</priority>\n";
        echo "</url>\n";
    }
}

// ======================================================
// ADD THE NEW BLOG DETAILS CODE HERE
// ======================================================
// Dynamic Blog Details Pages
// Dynamic Blog Details Pages
$articles = $pdo->query("SELECT id, title, slug, publish_date FROM articles WHERE publish_date <= CURDATE()");
if ($articles) {
    while ($row = $articles->fetch(PDO::FETCH_ASSOC)) {
        // Construct the URL first
        $blog_url = $base_url . "/blog-details.php?id=" . $row['id'] . "&slug=" . urlencode($row['title']);

        echo "<url>\n";
        // Apply htmlspecialchars to the *entire* URL string for XML compliance
        echo "<loc>" . htmlspecialchars($blog_url, ENT_XML1, 'UTF-8') . "</loc>\n"; // Use ENT_XML1 for XML-specific entities
        echo "<lastmod>" . date('Y-m-d', strtotime($row['publish_date'])) . "</lastmod>\n";
        echo "<changefreq>monthly</changefreq>\n";
        echo "<priority>0.8</priority>\n";
        echo "</url>\n";
    }
}
// ======================================================
// END OF NEW BLOG DETAILS CODE
// ======================================================

// Close the XML tag - THIS SHOULD ONLY BE CALLED ONCE AT THE VERY END
echo "</urlset>";
?>