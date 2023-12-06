<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Update the reservation status to approved
    $updateSql = "UPDATE Users SET hasAttendedOrNot = 1, hasBookedOrNot = 0 WHERE id = $userId";

    $updateResult = mysqli_query($conn, $updateSql);

    // Delete previous reservations for the user excluding the newly inserted one
    $delete_previous_reservations_query = "DELETE FROM BookingInfo WHERE user_id = '$userId' AND id <> LAST_INSERT_ID()";
    if (!mysqli_query($conn, $delete_previous_reservations_query)) {
        echo "Error deleting previous reservations: " . mysqli_error($conn);
        exit(); // Exit to prevent further execution
    }

    if ($updateResult) {
        echo "Reservation approved successfully.";
    } else {
        echo "Error approving reservation: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
