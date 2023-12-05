<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $bookingId = $_GET['id'];

    // Update the reservation status to approved
    $updateSql = "UPDATE BookingInfo SET approvedOrNot = 1 WHERE id = $bookingId";
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
