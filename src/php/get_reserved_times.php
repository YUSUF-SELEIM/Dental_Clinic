<?php include '../config/db.php'; ?>

<?php
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reserved times from the database
$sql = "SELECT booking_day, booking_time FROM BookingInfo";
$result = $conn->query($sql);

// Check for errors in the query
if (!$result) {
    die("Error in SQL query: " . $conn->error);
}

// Initialize an empty array to store reserved times
$reservedTimes = [];
$reservedTimes['sunday'] = [];
$reservedTimes['tuesday'] = [];
$reservedTimes['thursday'] = [];

// Check if there are rows in the result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $day = $row['booking_day'];
        $time = $row['booking_time'];

        // Check the day and add time accordingly
        if ($day == 'sunday') {
            $reservedTimes['sunday'][] = $time;
        } elseif ($day == 'tuesday') {
            $reservedTimes['tuesday'][] = $time;
        } elseif ($day == 'thursday') {
            $reservedTimes['thursday'][] = $time;
        }
    }
} else {
    // No rows found in the result
    echo "No data found in the database.";
}

// Close the database connection
$conn->close();

// Send the reserved times as a JSON response
echo json_encode($reservedTimes);
?>
