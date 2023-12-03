/* eslint-disable prefer-const */
const sundayButton = document.getElementById("sunday-radio");
const tuesdayButton = document.getElementById("tuesday-radio");
const thursdayButton = document.getElementById("thursday-radio");

const sundayTwo = document.getElementById("sunday-two");
const sundayFour = document.getElementById("sunday-four");
const sundaySix = document.getElementById("sunday-six");

const tuesdayTwo = document.getElementById("tuesday-two");
const tuesdayFour = document.getElementById("tuesday-four");
const tuesdaySix = document.getElementById("tuesday-six");

const thursdayTwo = document.getElementById("thursday-two");
const thursdayFour = document.getElementById("thursday-four");
const thursdaySix = document.getElementById("thursday-six");

const buttons = [sundayButton, tuesdayButton, thursdayButton];
const sundayTimes = [sundayTwo, sundayFour, sundaySix];
const tuesdayTimes = [tuesdayTwo, tuesdayFour, tuesdaySix];
const thursdayTimes = [thursdayTwo, thursdayFour, thursdaySix];

// let reservedTimes = {
//     sunday: [],
//     tuesday: [],
//     thursday: [],
// };

let reservedTimes = {};

async function reservedTimesFetcher() {
  // Fetch reserved times from the server
  await fetch("get_reserved_times.php")
    .then((response) => response.json())
    .then((data) => {
      reservedTimes = data;
      isThatTimeAlreadyReserved();
    })
    .catch((error) => console.error("Error:", error));
  console.log(reservedTimes);
}

reservedTimesFetcher();

sundayTimes.forEach((time) => {
  time.addEventListener("click", () => {
    if (reservedTimes.sunday.includes(time.value)) {
      time.disabled = true;
    }
    sendDataToServer("sunday", time.value);
    disableButton();
  });
});

console.log(reservedTimes.sunday);

tuesdayTimes.forEach((time) => {
  time.addEventListener("click", () => {
    if (reservedTimes.tuesday.includes(time.value)) {
      time.disabled = true;
    }
    sendDataToServer("tuesday", time.value);
    disableButton();
  });
});

console.log(reservedTimes.tuesday);

thursdayTimes.forEach((time) => {
  time.addEventListener("click", () => {
    if (reservedTimes.thursday.includes(time.value)) {
      time.disabled = true;
    }
    sendDataToServer("thursday", time.value);
    disableButton();
  });
});

console.log(reservedTimes.thursday);

function disableButton() {
  buttons.forEach((button) => {
    button.disabled = true;
  });
}
function isThatTimeAlreadyReserved() {
  sundayTimes.forEach((time) => {
    if (reservedTimes.sunday.includes(time.value)) {
      console.log("hey");
      time.disabled = true;
      time.parentElement.parentElement.remove();
    }
  });

  tuesdayTimes.forEach((time) => {
    if (reservedTimes.tuesday.includes(time.value)) {
      time.disabled = true;
      time.parentElement.parentElement.remove();
    }
  });

  thursdayTimes.forEach((time) => {
    if (reservedTimes.thursday.includes(time.value)) {
      time.disabled = true;
      time.parentElement.parentElement.remove();
    }
  });
}

function sendDataToServer(day, time) {
  const formData = new FormData();
  formData.append("booking_day", day);
  formData.append("booking_time", time);

  fetch("sending_day_and_time_from_js_to_php.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => console.log(data))
    .catch((error) => console.error("Error:", error));
}
