<?php
include "config.php";
session_start();

// Ensure user is logged in
if (!isset($_SESSION['vendor_id'])) {
    header("Location: ../login.php");
    exit();
}

$vendor_id = $_SESSION['vendor_id'];

// Fetch the current vendor data
$query = $pdo->prepare("SELECT * FROM vendors WHERE vendor_id = ?");
$query->execute([$vendor_id]);
$vendor = $query->fetch(PDO::FETCH_ASSOC);

if (!$vendor) {
    die("Vendor not found!");
}

// Prepare data from the form
$tax_id = $_POST['tax_id'] ?? $vendor['tax_id'];
$business_name = $_POST['business_name'] ?? $vendor['business_name'];
$business_address = $_POST['business_address'] ?? $vendor['business_address'];
$business_phone_code = $_POST['business_phone_code'] ?? $vendor['business_phone_code'];
$business_phone = $_POST['business_phone'] ?? $vendor['business_phone'];
$business_email = $_POST['business_email'] ?? $vendor['business_email'];
$website_url = $_POST['website_url'] ?? $vendor['website_url'];
$contact_name = $_POST['contact_name'] ?? $vendor['contact_name'];
$contact_phone_code = $_POST['contact_phone_code'] ?? $vendor['contact_phone_code'];
$contact_phone = $_POST['contact_phone'] ?? $vendor['contact_phone'];
$bank_name = $_POST['bank_name'] ?? $vendor['bank_name'];
$account_number = $_POST['account_number'] ?? $vendor['account_number'];
$account_holder = $_POST['account_holder'] ?? $vendor['account_holder'];
$iban = $_POST['iban'] ?? $vendor['iban'];
$swift_code = $_POST['swift_code'] ?? $vendor['swift_code'];
$password = $vendor['password']; // Default to existing password


if (!empty($website_url) && !preg_match('#^https?://#i', $website_url)) {
    $website_url = 'https://' . $website_url;
}
// Handle password update if provided
if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
}

// Handle profile picture upload
$profile_picture = $vendor['profile_picture'];
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $file_name = time() . "_" . basename($_FILES['profile_picture']['name']);
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $profile_picture = 'uploads/' . $file_name;
    move_uploaded_file($file_tmp, $profile_picture);
}

// Handle logo upload
$logo = $vendor['logo'];
if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
    $file_name = time() . "_" . basename($_FILES['logo']['name']);
    $file_tmp = $_FILES['logo']['tmp_name'];
    $logo = 'uploads/' . $file_name;
    move_uploaded_file($file_tmp, $logo);
}

// Update the vendor's profile in the database
$query = $pdo->prepare("UPDATE vendors SET 
    tax_id = ?, business_name = ?, business_address = ?, business_phone_code = ?, business_phone = ?, 
    business_email = ?,website_url=?,  contact_name = ?, contact_phone_code = ?, contact_phone = ?, 
    profile_picture = ?, logo = ?, bank_name = ?, account_number = ?, 
    account_holder = ?, iban = ?, swift_code = ?, password = ?
WHERE vendor_id = ?");

$query->execute([
    $tax_id, $business_name, $business_address, $business_phone_code, $business_phone, 
    $business_email, $website_url ,$contact_name, $contact_phone_code, $contact_phone, 
    $profile_picture, $logo, $bank_name, $account_number, 
    $account_holder, $iban, $swift_code, $password, $vendor_id
]);

// Redirect back to the profile page with a success message
header("Location: vendor-profile.php?success=Profile updated successfully!");
exit();
?>
