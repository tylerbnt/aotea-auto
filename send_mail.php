<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Change this to your desired email address
    $to = "contact@aoteaauto.co.nz";
    $subject = "New Booking/Contact Form Submission";

    // Sanitize and collect input
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"] ?? ''));
    $message = htmlspecialchars(trim($_POST["message"] ?? ''));

    // Build the email content
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    if (!empty($phone)) {
        $body .= "Phone: $phone\n";
    }
    $body .= "\nMessage:\n$message";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $body, $headers)) {
        // Success message (you can redirect to a thank you page instead)
        echo "<p>Thank you for your message, $name! We will get back to you soon.</p>";
    } else {
        // Failure message
        echo "<p>Sorry, your message could not be sent. Please try again later.</p>";
    }
} else {
    // If not submitted via POST, redirect to contact page
    header("Location: contact.html");
    exit();
}
?>
