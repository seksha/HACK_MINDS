<?php
// Database connection parameters
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to store appointment in the database
function scheduleAppointment($doctorId, $patientId) {
    global $conn;
    $sql = "INSERT INTO appointments (doctor_id, patient_id) VALUES ('$doctorId', '$patientId')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to retrieve appointments for a specific patient
function getPatientAppointments($patientId) {
    global $conn;
    $sql = "SELECT * FROM appointments WHERE patient_id = '$patientId'";
    $result = $conn->query($sql);
    $appointments = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
    }
    return $appointments;
}

// Function to retrieve appointments for a specific doctor
function getDoctorAppointments($doctorId) {
    global $conn;
    $sql = "SELECT * FROM appointments WHERE doctor_id = '$doctorId'";
    $result = $conn->query($sql);
    $appointments = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
    }
    return $appointments;
}

// Close connection
$conn->close();
?>
