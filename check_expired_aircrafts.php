<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php';             // uses $pdo (PDO)
require 'vendor/autoload.php';    // SendGrid library

use SendGrid\Mail\Mail;

// ✅ Fetch aircrafts expiring in exactly 7 days and not notified
$query = "
    SELECT a.aircraft_id, a.model, a.expires_at, v.business_email AS email 
    FROM aircrafts a 
    JOIN vendors v ON a.vendor_id = v.vendor_id
    WHERE DATE(a.expires_at) = CURDATE() + INTERVAL 7 DAY 
    AND a.status = 'approved' 
    AND a.notified = 0
";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $aircrafts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($aircrafts)) {
        echo "No matching aircraft found.<br>";
    } else {
        echo "Found " . count($aircrafts) . " aircraft(s).<br>";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$sendgrid_api_key = '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';  // Your key
$fromEmail = "Jpcoston@authenticAlabamafans.Com";        // Must be verified in SendGrid
$fromName  = "Authentic Alabama Fans";

foreach ($aircrafts as $row) {
    $email = $row['email'];
    $aircraftName = $row['model'];

    $mail = new Mail();
    $mail->setFrom($fromEmail, $fromName);
    $mail->setSubject("Renew your aircraft listing: $aircraftName");
    $mail->addTo($email);

    $plainText = "Hi,\n\nYour aircraft listing ($aircraftName) is about to expire in 7 days.\nPlease renew it to keep it live on the platform.\n\nThank you!";
    $mail->addContent("text/plain", $plainText);

    $htmlContent = "
        <p>Hi,</p>
        <p>Your aircraft listing <strong>$aircraftName</strong> is about to expire in 7 days.</p>
        <p>Please <a href='https://your-site.com/renew'>renew it</a> to keep it active on the platform.</p>
        <p>Thank you!</p>
    ";
    $mail->addContent("text/html", $htmlContent);

    $sendgrid = new \SendGrid($sendgrid_api_key);

    try {
        echo "Sending email to $email for aircraft: $aircraftName...<br>";
        $response = $sendgrid->send($mail);

        if ($response->statusCode() >= 200 && $response->statusCode() < 300) {
            echo "Email sent successfully to $email.<br>";

            // ✅ Update notified column
            $updateStmt = $pdo->prepare("UPDATE aircrafts SET notified = 1 WHERE aircraft_id = ?");
            $updateStmt->execute([$row['aircraft_id']]);
        } else {
            echo "Failed to send email. Response code: " . $response->statusCode() . "<br>";
            error_log("Failed to send email to $email. Status Code: " . $response->statusCode());
        }
    } catch (Exception $e) {
        echo "SendGrid Error: " . $e->getMessage() . "<br>";
        error_log("SendGrid Error for $email: " . $e->getMessage());
    }
}

echo "Renewal emails sent (if any were due).";

?>
