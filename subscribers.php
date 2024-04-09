<?php
// Check if the form was submitted
echo "Form submitted.<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email input
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Connect to the database
    echo "Connecting to the database...<br>";
    $conn = new mysqli('localhost', 'root', '', 'subscribers_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to insert email
    echo "Executing SQL query...<br>";
    $sql = "INSERT INTO subscribers (email) VALUES ('$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Thank you for subscribing!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
