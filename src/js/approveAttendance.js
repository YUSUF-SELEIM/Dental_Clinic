/* eslint-disable no-unused-vars */
function approveAttendance(id) {
    // Send an AJAX request to update the database and refresh the page
    fetch(`approve_attendance.php?id=${id}`, {
        method: 'GET',
    })
        .then(response => response.text())
        .then(() => location.reload())
        .catch(error => console.error("Error approving attendance:", error));
}
