<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your MySQL database
    $servername = "localhost"; // Update this if needed
    $username = "root"; // Update this if needed
    $password = ""; // Update this if needed
    $dbname = "ipl"; // Update this if needed

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement for match_table
    $stmt_match = $conn->prepare("INSERT INTO match_table (match_no, m_date, m_timing, venue, team, op_team) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt_match->bind_param("isssss", $match_no, $m_date, $m_timing, $venue, $team, $op_team);

    // Assign values from POST data to variables
    $match_no = $_POST['match_no'];
    $m_date = $_POST['m_date'];
    $m_timing = $_POST['m_timing'];
    $venue = $_POST['venue'];
    $team = $_POST['team'];
    $op_team = $_POST['op_team'];

    // Execute the prepared statement
    if ($stmt_match->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt_match->error;
    }

    // Close statement and connection
    $stmt_match->close();
    $conn->close();
}
?>
