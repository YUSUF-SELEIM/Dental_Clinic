async function bookedOrNotFetcher() {
    await fetch("sending_hasBookedOrNot_from_js_to_php.php")
  .then((response) => response.json())
  .then((data) => {
    if (data.registered) {
      // User is registered
      console.log("registered");
      if (data.hasBookedOrNot === '1') {
        // User has booked, hide or show divs accordingly
        console.log("booked");
        document.getElementById("booking-form").classList.add('hidden');
        document.getElementById("booking-confirmation").classList.remove('hidden');
      } else {
        // User has not booked, handle accordingly
        console.log("not booked");
        document.getElementById("booking-form").classList.remove('hidden');
        document.getElementById("booking-confirmation").classList.add('hidden');
      }
    } else {
      // User is not registered, display a div or take appropriate action
      console.log("User not registered");
    //   document.getElementById("registration-div").classList.remove('hidden');
      // Also hide other divs if needed
      document.getElementById("booking-form").classList.add('hidden');
      document.getElementById("booking-confirmation").classList.add('hidden');
    }
  })
  .catch((error) => console.error("Error fetching user status:", error));
}
bookedOrNotFetcher();