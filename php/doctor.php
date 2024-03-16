<?php
include 'connection.php';

// Retrieve form data
$uname = $_POST['username'];
$upswd = $_POST['password'];
$doc_id = $_POST['patient_id'];

if (!empty($uname) || !empty($upswd) || !empty($doc_id)) {
    // Check if connection is established
    if ($conn) {
        // Prepare and execute SQL statement
        $sql = "SELECT * FROM doctors WHERE uname = ? AND password = ? AND doc_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $uname, $upswd, $doc_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any row is returned
        if ($result->num_rows > 0) {
            echo "Login successful"; // You can redirect the user to another page here
        } else {
            echo "Invalid username, password, or doctor ID";
        }
        $stmt->close();
    } else {
        echo "Database connection failed";
    }
} else {
    echo "All fields are required";
}
?>
