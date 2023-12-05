<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Update the reservation status to approved
    $updateSql = "UPDATE Users SET hasAttendedOrNot = 1 WHERE id = $userId";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        echo "Reservation approved successfully.";
    } else {
        echo "Error approving reservation: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
