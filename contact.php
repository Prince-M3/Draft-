<?php
$host = "localhost";
$username = "root"; // default in XAMPP
$password = "";
$database = "contact_form";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// SQL Insert
$sql = "INSERT INTO messages (full_name, email, subject, message)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $full_name, $email, $subject, $message);

if ($stmt->execute()) {
  echo "Message sent successfully!";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
