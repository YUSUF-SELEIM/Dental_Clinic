<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_email'])) {
    $guestOrUser = "Book Now";
} else {
    $guestOrUser = $_SESSION['user_email'];

    // Retrieve the user_id from the Users table based on the email
    $user_query = "SELECT id FROM Users WHERE email = '$guestOrUser'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_id = $user_row['id'];
        $_SESSION['user_id'] = $user_id;
    } else {
        echo "User not found.";
    }
}

$first_name = $last_name = $symptoms = $booking_day = $booking_time = $user_id = '';
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['first-name'])) {
        $first_name = filter_input(
            INPUT_POST,
            'first-name',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if (!empty($_POST['last-name'])) {
        $last_name = filter_input(
            INPUT_POST,
            'last-name',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if (!empty($_POST['symptoms'])) {
        $symptoms = filter_input(
            INPUT_POST,
            'symptoms',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if (!empty($_SESSION['booking_day'])) {
        $booking_day = $_SESSION['booking_day'];
    }
    if (!empty($_SESSION['booking_time'])) {
        $booking_time = $_SESSION['booking_time'];
    }
    $user_id = $_SESSION['user_id'];

    // Reset hasAttendedOrNot to 0 when a new reservation is made
    $reset_hasAttended_query = "UPDATE Users SET hasAttendedOrNot = 0 WHERE id = '$user_id'";
    if (!mysqli_query($conn, $reset_hasAttended_query)) {
        echo "Error resetting hasAttendedOrNot: " . mysqli_error($conn);
        exit(); // Exit to prevent further execution
    }

    // Insert the new reservation
    $sql = "INSERT INTO BookingInfo (first_name, last_name, symptoms, booking_day, booking_time, user_id)
     VALUES ('$first_name','$last_name' , '$symptoms','$booking_day','$booking_time','$user_id')";

    if (mysqli_query($conn, $sql)) {
        // Update the Users table to set bookedOrNot to TRUE for the specified user
        $update_user_bookedOrNot_query = "UPDATE Users SET hasBookedOrNot = 1 WHERE id = '$user_id'";
        if (mysqli_query($conn, $update_user_bookedOrNot_query)) {
            $_SESSION['user_id'] = $user_id;
            echo "Sent";
            header("Location: user_page.php");
            exit(); // Make sure to exit to prevent further execution
        } else {
            echo "Error updating user status: " . mysqli_error($conn);
        }
    } else {
        echo "Error" . mysqli_error($conn);
    }
}

if (isset($_POST['log-out'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: authentication.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/eb2112263c.js" crossorigin="anonymous"></script>
    <script src="../js/form-validations/booking-form-validation.js" defer></script>
    <script src="../js/day-time-coordinator.js" defer></script>
    <script src="../js/booking_and_approval_fetcher.js" defer></script>
    <script src="../js/showHistory.js" defer></script>
    <script src="../js/darkmode.js" defer></script>
    <script>
        if (
            localStorage.getItem("color-theme") === "dark" ||
            (!("color-theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    </script>
    <title>Dashboard</title>
</head>

<body class="flex flex-col bg-gray-50 dark:bg-gray-900">
    <header class="flex justify-between items-center p-2 h-full">
        <div class="flex items-center p-2 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
            Flowbite
        </div>
        <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"> <i class="fa-solid fa-user"></i> <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div>Welcome ,</div>
                <div class="font-medium truncate"> <?php
                                                    if (!isset($_SESSION['user_email'])) {
                                                        echo '<a href="authentication.php" class="text-red-600">' . $guestOrUser . '</a>';
                                                    } else {
                                                        echo '<div>' . $guestOrUser . '</div>';
                                                    }
                                                    ?></div>
            </div>
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
                <li class="flex justify-center">
                    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:animate-spin focus:outline-none rounded-lg text-sm p-2.5">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>
            </ul>
            <div class="py-2 flex justify-center">
                <?php
                if (isset($_SESSION['user_email'])) {
                    echo '        <form method="post">
                        <button type="submit" name="log-out" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"><i class="fa-solid fa-arrow-right-from-bracket"></i>  Log Out</button>
                    </form>';
                }
                ?>
            </div>
        </div>
    </header>
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="user-tabs" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300" id="booking-tab" type="button" role="tab" aria-controls="booking-content" aria-selected="false">
                    Booking
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button onclick="showUserHistory(<?php echo $_SESSION['user_id']; ?>)" class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300" id="history-tab" type="button" role="tab" aria-controls="history-content" aria-selected="false">
                    History
                </button>
            </li>
        </ul>
    </div>
    <div id="tabContentExample" class="p-2">
        <div class="hidden rounded-lg  flex justify-center" id="booking-content" role="tabpanel" aria-labelledby="booking-tab">

            <div id="booking-form" class="hidden w-full  bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-3 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Book an Appointment
                    </h1>
                    <form id="form" class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="flex space-x-2">
                            <div>
                                <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name<span id="first-name-validation" class="text-lg text-red-600"> *</span></label>
                                <input type="text" name="first-name" id="first-name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white " placeholder="Yusuf" required>
                            </div>
                            <div>
                                <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name<span id="last-name-validation" class="text-lg text-red-600"> *</span></label>
                                <input type="text" name="last-name" id="last-name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg   block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white " placeholder="Abdelfattah" required>
                            </div>
                        </div>
                        <div>
                            <label for="symptoms" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Describe Your Symptoms<span id="symptoms-name-validation" class="text-lg text-red-600"> *</span></label>
                            <textarea name="symptoms" id="symptoms" rows="5" class="resize-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your symptoms here..." required></textarea>
                        </div>
                        <div class="flex space-x-5 justify-center">
                            <?php include('./days-and-times/sunday.php'); ?>
                            <?php include('./days-and-times/tuesday.php'); ?>
                            <?php include('./days-and-times/thursday.php'); ?>
                        </div>
                        <button name="submit" class="w-full text-gray bg-gray-200 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Book Now</button>
                    </form>
                </div>
            </div>
            <div id="booking-confirmation" class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
                <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                    <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    You have successfully booked an appointment. Your booking is awaiting admin approval.
                </p>
            </div>
            <div id="approval-confirmation" class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
                <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                    <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                    Your reservation has been successfully approved <br>
                    We look forward to your presence at the scheduled appointment. <br>
                    Please ensure to attend on time

                </p>
            </div>
        </div>
        <div class="hidden rounded-lg " id="history-content" role="tabpanel" aria-labelledby="history-tab">
            <ol class="list-decimal list-inside m-5">
            </ol>
        </div>
    </div>
    <script src="../../dist/userTabsBundle.js"></script>
</body>

</html>