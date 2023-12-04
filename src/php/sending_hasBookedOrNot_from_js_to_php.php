<?php
include '../config/db.php';

session_start();

if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];

    $hasBookedOrNot_query = "SELECT hasBookedOrNot FROM Users WHERE email = '$user_email'";
    $hasBookedOrNot_query_result = mysqli_query($conn, $hasBookedOrNot_query);

    if ($hasBookedOrNot_query_result) {
        if ($hasBookedOrNot_query_result->num_rows > 0) {
            $row = mysqli_fetch_assoc($hasBookedOrNot_query_result);
            $hasBookedOrNot = $row['hasBookedOrNot'];

            // Check if the user has booked
            if ($hasBookedOrNot == 1) {
                echo json_encode(['registered' => true, 'hasBookedOrNot' => $hasBookedOrNot]);
            } else {
                // User is registered but has not booked
                echo json_encode(['registered' => true, 'hasBookedOrNot' => $hasBookedOrNot]);
            }
        } else {
            // No rows found, handle accordingly (e.g., user not found)
            echo json_encode(['error' => 'No user found with the specified ID']);
        }
    } else {
        // Query execution error
        echo json_encode(['error' => "Error: " . mysqli_error($conn)]);
    }
} else {
    // User is not logged in
    echo json_encode(['registered' => false]);
}
?>
