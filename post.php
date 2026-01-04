<?php

// ------------------ FUNCTIONS ------------------

// Sanitize input data
function sanitizeData($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Read JSON file
function readJsonFile($filename) {
    if (!file_exists($filename)) {
        return [];
    }
    $jsonData = file_get_contents($filename);
    return json_decode($jsonData, true);
}

// Write JSON file
function writeJsonFile($filename, $data) {
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

// ------------------ CONFIG ------------------
$infoJsonFile = 'info.json';
$adminEmail = 'info@artiscrafts.com'; // Your email

// ------------------ START SESSION ------------------
session_start();

// Assign serial number
$serialNumber = $_SESSION['serial_number'] ?? null;

// ------------------ HANDLE POST ------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $formData = $_POST;

    // Determine form type
    $formType = $formData['form_type'] ?? 'query_form'; // default to query form

    // Assign serial number if not set
    if ($serialNumber === null || basename($_SERVER["HTTP_REFERER"]) == "index.html") {
        $serialNumber = uniqid();
        $_SESSION['serial_number'] = $serialNumber;
    }

    // Sanitize form data
    $sanitizedData = array_map('sanitizeData', $formData);
    $sanitizedData['serial_number'] = $serialNumber;
    $sanitizedData['entry_date_time'] = date('Y-m-d H:i:s');

    // Read existing JSON
    $jsonData = readJsonFile($infoJsonFile);

    // Make sure form_type key exists
    if (!isset($jsonData[$formType])) {
        $jsonData[$formType] = [];
    }

    // Save current submission
    $jsonData[$formType][] = $sanitizedData;

    // Write back to JSON file
    writeJsonFile($infoJsonFile, $jsonData);

    // ------------------ EMAIL NOTIFICATION ------------------
    $subject = $formType === 'query_form' ? "New Query Form Submission" : "New Contact Form Submission";

    $message = "You have received a new submission from your website:\n\n";

    foreach ($sanitizedData as $key => $value) {
        if ($key !== 'form_type') {
            $message .= ucfirst($key) . ": " . $value . "\n";
        }
    }

    $headers = "From: no-reply@yourwebsite.com";

    // Send email
    mail($adminEmail, $subject, $message, $headers);

    // ------------------ OPTIONAL: SUCCESS MESSAGE ------------------
    // If using JS, you can show a success message on the front end.
}

?>
