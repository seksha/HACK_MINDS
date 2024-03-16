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

      // Create a database connection
      $conn = new mysqli("your_host", "your_username", "your_password", "your_database");

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Prepare SQL statement to insert data into the database
      $sql = "INSERT INTO doctors (patient_id, username, password) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $patient_id, $username, $password);

      // Execute the statement
      if ($stmt->execute()) {
          echo "Record inserted successfully.";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }

      // Close the statement and connection
      $stmt->close();
      $conn->close();
  }
  ?>