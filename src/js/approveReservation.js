/* eslint-disable no-unused-vars */
function approveReservation(bookingId) {
    // Send an AJAX request to update the database and refresh the page
    console.log(bookingId)
    fetch(`../php/approve_reservation.php?id=${bookingId}`, {
        method: 'GET',
    })
        .then(response => response.text())
        .then(() => location.reload())
        .catch(error => console.error("Error approving reservation:", error));
}
 