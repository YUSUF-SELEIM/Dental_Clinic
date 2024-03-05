<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    echo "HERE";
    $user_id = $_GET['id'];

    // Reset hasBookedOrNot in Users table to zero
    $resetBookingSql = "UPDATE Users SET hasBookedOrNot = 0 WHERE id = '$user_id'";
    $resetBookingResult = mysqli_query($conn, $resetBookingSql);

    // Delete the user's reservation from BookingInfo table
    $deleteReservationSql = "DELETE FROM BookingInfo WHERE user_id = '$user_id'";
    $deleteReservationResult = mysqli_query($conn, $deleteReservationSql);

    if ($resetBookingResult && $deleteReservationResult) {
        echo "Reservation canceled successfully.";
        //  header("Location: user_page.php");
    } else {
        echo "Error canceling reservation: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
