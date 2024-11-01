<?php
  // Set your receiving email address here
  $receiving_email_address = 'welly70114@gmail.com';

  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Validate and sanitize input fields
      $from_name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
      $from_email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
      $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
      $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

      // Ensure all fields are filled out
      if (empty($from_name) || empty($from_email) || empty($subject) || empty($message)) {
          die("All fields are required.");
      }

      // Construct the email headers
      $headers = "From: $from_name <$from_email>\r\n";
      $headers .= "Reply-To: $from_email\r\n";
      $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

      // Build the email content
      $email_content = "From: $from_name\n";
      $email_content .= "Email: $from_email\n\n";
      $email_content .= "Subject: $subject\n\n";
      $email_content .= "Message:\n$message\n";

      // Send the email
      if (mail($receiving_email_address, $subject, $email_content, $headers)) {
          echo "Your message has been sent successfully.";
      } else {
          echo "Unable to send the message. Please try again later.";
      }
  } else {
      echo "Invalid request method.";
  }
?>
