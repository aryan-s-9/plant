<?php

// Database credentials
$host     = "localhost";
$user     = "u522649222_contact"; 
$password = "Shriaunsh@09";
$dbname   = "u522649222_form";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

$name    = $_POST['name'];
$email   = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Insert data using prepared statement
$stmt = $conn->prepare("INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {

    // --- EMAIL NOTIFICATION TO YOU ---
    $to = "support@planturaexport.com";
    $email_subject = "New Contact Form Message from $name";
    $email_body = "
    Name: $name
    Email: $email
    Subject: $subject
    Message:
    $message
    ";

    $headers = "From: no-reply@yourdomain.com";

    mail($to, $email_subject, $email_body, $headers);

    echo "SUCCESS";
} else {
    echo "ERROR";
}

$stmt->close();
$conn->close();

?>
