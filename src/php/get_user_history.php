<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user history
    $getHistoryQuery = "SELECT history FROM Users WHERE id = '$userId'";
    $historyResult = mysqli_query($conn, $getHistoryQuery);

    if ($historyResult) {
        $row = mysqli_fetch_assoc($historyResult);
        $history = $row['history'];

        echo json_encode(['history' => $history]);
    } else {
        echo json_encode(['error' => 'Error fetching user history']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
