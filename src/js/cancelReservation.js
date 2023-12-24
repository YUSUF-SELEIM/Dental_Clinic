/* eslint-disable no-unused-vars */
function cancelReservation(userId) {
    // Send an AJAX request to update the database and refresh the page
    console.log(userId)
    fetch(`../php/cancel_reservation.php?id=${userId}`, {
        method: 'GET',
    })
        .then(response => response.text())
        .then(() => location.reload())
        .catch(error => console.error("Error cancelling reservation:", error));
}
