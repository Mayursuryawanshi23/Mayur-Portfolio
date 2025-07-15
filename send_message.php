<?php

// ONLY PROCESS FORM IF IT'S A POST REQUEST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Collect form data and sanitize it
    // Using strip_tags to remove HTML and PHP tags from strings
    // Using trim to remove whitespace from the beginning and end of strings
    // Using filter_var for email validation and sanitization

    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // 2. Validate the collected data
    // Check if any required fields are empty or if email is invalid
    if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)) {
        // Set a 400 (Bad Request) response code and exit
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please ensure all fields are filled correctly.";
        exit;
    }

    // 3. Set your recipient email address
    // THIS IS THE EMAIL ADDRESS WHERE YOU WANT TO RECEIVE THE MESSAGES
    $recipient = "mayursuryawanshi089@gmail.com"; // <-- IMPORTANT: CHANGE THIS TO YOUR ACTUAL EMAIL ADDRESS!

    // 4. Construct the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // 5. Construct the email headers
    // The "From" header is crucial for replies and identifying the sender
    $email_headers = "From: $name <$email>";

    // 6. Send the email using PHP's built-in mail() function
    // The mail() function returns true on success, false on failure
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // If successful, set a 200 (OK) response code
        http_response_code(200);
        echo "Thank You! Your message has been sent successfully.";
    } else {
        // If mail() function fails, set a 500 (Internal Server Error) response code
        http_response_code(500);
        echo "Oops! Something went wrong on the server, and we couldn't send your message. Please try again later.";
    }

} else {
    // If the script was accessed directly via GET request (not a form submission)
    // Set a 403 (Forbidden) response code
    http_response_code(403);
    echo "Access Denied: This script can only be accessed via a form submission.";
}

?>