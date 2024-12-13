<?php
$servername = "localhost"; // Hostname for the MySQL server
$username = "root";        // MySQL username
$password = "";            // MySQL password (if any)
$dbname = "contact_form";  // Database name

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Prepare and bind the SQL query
    $stmt = $conn->prepare("INSERT INTO contacts (first_name, middle_name, last_name, email, phone_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $middle_name, $last_name, $email, $phone_number);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Your message has been sent successfully!');</script>";
    } else {
        echo "<script>alert('There was an error submitting your form. Please try again.');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
