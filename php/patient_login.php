<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    $patient_id = $_POST['patient_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate and sanitize data
    // (You should perform more robust validation and sanitization in a real-world application)
    $patient_id = filter_var($patient_id, FILTER_SANITIZE_STRING);
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // Prepare data to write to file
    $data = "$patient_id,$username,$password\n";

    // Define the file path
    $file_path = "data.txt"; // You can change this to your desired file path

    // Write data to file
    if (file_put_contents($file_path, $data, FILE_APPEND | LOCK_EX) !== false) {
        echo "Record inserted successfully.";
    } else {
        echo "Error writing to file.";
    }
}
?>
