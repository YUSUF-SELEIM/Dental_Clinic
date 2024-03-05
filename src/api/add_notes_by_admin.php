<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user_id = $_POST['user_id'];
    $history = $_POST['history'];

    // Fetch the current history for the user
    $getCurrentHistoryQuery = "SELECT history FROM Users WHERE id = '$user_id'";
    $currentHistoryResult = mysqli_query($conn, $getCurrentHistoryQuery);

    if ($currentHistoryResult) {
        $row = mysqli_fetch_assoc($currentHistoryResult);
        $currentHistory = $row['history'];

        // Concatenate new notes to the existing history
        $updatedHistory = $currentHistory . "\n" . $history;

        // Update the history column
        $updateHistoryQuery = "UPDATE Users SET history = '$updatedHistory' WHERE id = '$user_id'";
        $updateHistoryResult = mysqli_query($conn, $updateHistoryQuery);

        if ($updateHistoryResult) {
            echo "Notes added successfully.";
            header("Location: admin_page.php");
        } else {
            echo "Error updating notes: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching current history: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
