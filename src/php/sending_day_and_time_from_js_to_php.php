<?php
session_start();

    $booking_day = $_POST['booking_day'];
    $booking_time = $_POST['booking_time'];

    $_SESSION['booking_day'] = $booking_day;
    $_SESSION['booking_time'] = $booking_time;
    // Combine data into a single array
    $response = [
        'status' => 'success',
        'booking-day' => $booking_day,
        'booking-time' => $booking_time,
    ];

    // Send a response back to JavaScript
    echo json_encode($response);
// }