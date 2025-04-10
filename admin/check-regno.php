<?php
include('../includes/dbconn.php');

if (isset($_POST['regno'])) {
    $regno = $_POST['regno'];

    $stmt = $mysqli->prepare("SELECT regNo FROM userRegistration WHERE regNo = ?");
    $stmt->bind_param('s', $regno);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "unavailable"; // Registration number already exists
    } else {
        echo "available"; // Registration number is available
    }
    $stmt->close();
}
?>