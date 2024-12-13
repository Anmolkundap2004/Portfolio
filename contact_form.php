<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $stmt = $conn->prepare("INSERT INTO contacts (first_name, middle_name, last_name, email, phone_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $middle_name, $last_name, $email, $phone_number);

    if ($stmt->execute()) {
        echo "<script>alert('Your message has been sent successfully!');</script>";
    } else {
        echo "<script>alert('There was an error submitting your form. Please try again.');</script>";
    }

    $stmt->close();
}

if (isset($_POST['show'])) {
    $query = "SELECT first_name, last_name, email, phone_number FROM contacts";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<table class="data-table">';
        echo '<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['first_name'] . '</td>';
            echo '<td>' . $row['last_name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['phone_number'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "<p>No records found.</p>";
    }
}

$conn->close();
?>
