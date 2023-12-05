async function bookingAndApprovalFetcher() {
  await fetch("sending_approval_and_booking_info_from_php_to_js.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.registered) {
        // User is registered
        console.log("registered");
        if (data.hasBookedOrNot === '1') {
          // User has booked
          console.log("booked");
          if (data.approvedOrNot === '1') {
            // i am booked and approved 
            console.log("booked and approved");
            if(data.hasAttendedOrNot === '1'){
              console.log("booked and approved and attended");
              document.getElementById("booking-confirmation").classList.add('hidden');
              document.getElementById("approval-confirmation").classList.add('hidden');
              document.getElementById("booking-form").classList.remove('hidden');
            }else{
              console.log("booked and approved and not attended");
              document.getElementById("booking-form").classList.add('hidden');
              document.getElementById("booking-confirmation").classList.add('hidden');
              document.getElementById("approval-confirmation").classList.remove('hidden');
            }
          } else {
            // i am booked but not approved yet
            console.log("booked and not approved yet");
            document.getElementById("booking-form").classList.add('hidden');
            document.getElementById("approval-confirmation").classList.add('hidden');
            document.getElementById("booking-confirmation").classList.remove('hidden');
          }
        } else {
          // User has not booked
          console.log("not booked");
          document.getElementById("booking-confirmation").classList.add('hidden');
          document.getElementById("approval-confirmation").classList.add('hidden');
          document.getElementById("booking-form").classList.remove('hidden');
        }
      } else {
        // User is not registered, display a div or take appropriate action
        console.log("User not registered");
        document.getElementById("booking-form").classList.add('hidden');
        document.getElementById("approval-confirmation").classList.add('hidden');
        document.getElementById("booking-confirmation").classList.add('hidden');
      }
    })
    .catch((error) => console.error("Error fetching user status:", error));
}
bookingAndApprovalFetcher();