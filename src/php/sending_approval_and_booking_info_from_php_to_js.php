<?php
include '../config/db.php';

session_start();

if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];

    $userQuery = "SELECT id, hasBookedOrNot, hasAttendedOrNot FROM Users WHERE email = '$user_email'";
    $userResult = mysqli_query($conn, $userQuery);

    if ($userResult) {
        if ($userResult->num_rows > 0) {
            $userRow = mysqli_fetch_assoc($userResult);
            $userId = $userRow['id'];
            $hasBookedOrNot = $userRow['hasBookedOrNot'];
            $hasAttendedOrNot = $userRow['hasAttendedOrNot'];

            // Check if the user has booked
            if ($hasBookedOrNot == 1) {
                // Check approval status
                $approvalQuery = "SELECT approvedOrNot FROM BookingInfo WHERE user_id = '$userId'";
                $approvalResult = mysqli_query($conn, $approvalQuery);

                if ($approvalResult) {
                    if ($approvalResult->num_rows > 0) {
                        $approvalRow = mysqli_fetch_assoc($approvalResult);
                        $approvedOrNot = $approvalRow['approvedOrNot'];

                        // Include hasAttendedOrNot in the response
                        echo json_encode(['registered' => true, 'hasBookedOrNot' => $hasBookedOrNot, 'hasAttendedOrNot' => $hasAttendedOrNot, 'approvedOrNot' => $approvedOrNot]);
                    } else {
                        // No rows found, handle accordingly (e.g., user not found)
                        echo json_encode(['error' => 'No user found with the specified ID']);
                    }
                } else {
                    // Query execution error
                    echo json_encode(['error' => "Error: " . mysqli_error($conn)]);
                }
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
