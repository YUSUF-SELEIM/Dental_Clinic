<?php include '../config/db.php';  ?>

<?php
session_start(); // Start the session
if (!isset($_SESSION['admin_email'])) {
    $guestOrUser = "Book Now";
} else {
    $guestOrUser = $_SESSION['admin_email'];
}

if (isset($_SESSION['admin_email'])) {
    // Fetch unapproved reservations
    $unapprovedUsers_query = "SELECT id ,first_name, last_name, symptoms, booking_day, booking_time , user_id  FROM BookingInfo WHERE approvedOrNot = 0";
    $result_unapprovedUsers_query = mysqli_query($conn, $unapprovedUsers_query);

    if (!$result_unapprovedUsers_query) {
        echo "Error: " . mysqli_error($conn);
    }

    $unattendedUsers_query = "SELECT id ,email, history  FROM Users WHERE hasAttendedOrNot = 0 AND hasBookedOrNot = 1";
    $result_unattendedUsers_query = mysqli_query($conn, $unattendedUsers_query);

    if (!$result_unattendedUsers_query) {
        echo "Error: " . mysqli_error($conn);
    }

    if (isset($_POST['log-out'])) {
        $_SESSION = array();
        session_destroy();
        header("Location: authentication.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/eb2112263c.js" crossorigin="anonymous"></script>
    <script src="../js/approveReservation.js" defer></script>
    <script src="../js/approveAttendance.js" defer></script>
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
        <a href="home_page.php" class="flex">
        <img src="../assets/logo.png" class="h-8  hover:animate-spin" alt="" />
            <div class="px-2">
                Dental <span class="text-blue-600">Smile</span>
            </div>
        </a>
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
                                                    if (!isset($_SESSION['admin_email'])) {
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
                if (isset($_SESSION['admin_email'])) {
                    echo '        <form method="post">
                        <button type="submit" name="log-out" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"><i class="fa-solid fa-arrow-right-from-bracket"></i>  Log Out</button>
                    </form>';
                }
                ?>
            </div>
        </div>
    </header>
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="admin-tabs" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300" id="approve-reservations-tab" type="button" role="tab" aria-controls="approve-reservations-content" aria-selected="false">
                    Approve Reservations
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300" id="approve-attendance-tab" type="button" role="tab" aria-controls="approve-attendance-content" aria-selected="false">
                    Approve Attendance
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300" id="admin-history-tab" type="button" role="tab" aria-controls="admin-history-content" aria-selected="false">
                    Add Notes
                </button>
            </li>
        </ul>
    </div>
    <div id="tabContentExample" class="p-2">
        <div class="hidden rounded-lg  flex justify-center" id="approve-reservations-content" role="tabpanel" aria-labelledby="approve-reservations-tab">

            <?php
            // Check if there are unapproved reservations
            if (mysqli_num_rows($result_unapprovedUsers_query) > 0) {
                // Display a table with user information and an "Approve" button for each
                echo "<div class='w-full relative overflow-x-auto shadow-md sm:rounded-lg'>

                    <table class='w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>
                    <thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
                    <tr >
                        <th class='py-2 px-4 border-b'>Name</th>
                        <th class='py-2 px-4 border-b'>Symptoms</th>
                        <th class='py-2 px-4 border-b'>Booking Day</th>
                        <th class='py-2 px-4 border-b'>Booking Time</th>
                        <th class='py-2 px-4 border-b'>User ID</th>
                        <th class='py-2 px-4 border-b'>Approve Reservation</th>
                    </tr>
                </thead>
                <tbody>";

                while ($row = mysqli_fetch_assoc($result_unapprovedUsers_query)) {
                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>

                <td class='py-2 px-4 border-b font-medium text-gray-900 whitespace-nowrap dark:text-white'>{$row['first_name']} {$row['last_name']}</td>
                <td class='py-2 px-4 border-b'>{$row['symptoms']}</td>
                <td class='py-2 px-4 border-b'>{$row['booking_day']}</td>
                <td class='py-2 px-4 border-b'>{$row['booking_time']}</td>
                <td class='py-2 px-4 border-b'>{$row['user_id']}</td>
                <td class='py-2 px-4 border-b flex justify-center'>
                    <button class='bg-blue-500 text-white px-3 py-1 rounded' onclick='approveReservation({$row['id']})'>Approve</button>
                </td>
            </tr>";
                }

                echo "</tbody>
        </table>
    </div>";
            } else {
                echo "<p class='text-gray-500'>No unapproved reservations.</p>";
            }
            ?>

        </div>
        <div class="hidden rounded-lg  flex justify-center" id="approve-attendance-content" role="tabpanel" aria-labelledby="approve-attendance-tab">
            <?php
            // Check if there are unapproved reservations
            if (mysqli_num_rows($result_unattendedUsers_query) > 0) {
                // Display a table with user information and an "Approve" button for each
                echo "<div class='w-full relative overflow-x-auto shadow-md sm:rounded-lg'>

                    <table class='w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>
                    <thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
                    <tr >
                        <th class='py-2 px-4 border-b'>id</th>
                        <th class='py-2 px-4 border-b'>Email</th>
                        <th class='py-2 px-4 border-b'>History</th>
                        <th class='py-2 px-4 border-b'>Approve Attendance</th>

                    </tr>
                </thead>
                <tbody>";

                while ($row = mysqli_fetch_assoc($result_unattendedUsers_query)) {
                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>

                <td class='py-2 px-4 border-b'>{$row['id']}</td>
                <td class='py-2 px-4 border-b'>{$row['email']}</td>
                <td class='py-2 px-4 border-b'>{$row['history']}</td>
                <td class='py-2 px-4 border-b flex justify-center'>
                    <button class='bg-blue-500 text-white px-3 py-1 rounded' onclick='approveAttendance({$row['id']})'>Approve</button>
                </td>
            </tr>";
                }

                echo "</tbody>
        </table>
    </div>";
            } else {
                echo "<p class='text-gray-500'>No unapproved attendances.</p>";
            }
            ?>
        </div>
        <div class="hidden rounded-lg" id="admin-history-content" role="tabpanel" aria-labelledby="admin-history-tab">
            <!-- Inside your admin panel HTML -->
            <section id="signin-form" class="w-full flex flex-col grow items-center justify-center px-6 py-6">
        <div class="w-full  bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Add Notes
                </h1>
                <form class="space-y-4 md:space-y-6" action="add_notes_by_admin.php" method="POST">        
                    <div>
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                        <input type="text" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="history" id="password-label" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
                        <textarea name="history" rows="4" cols="50" class="resize-none bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="w-full text-gray bg-gray-200 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add Notes</button>
                </form>
            </div>
        </div>
    </section>


        </div>
    </div>
    <script src="../../dist/adminTabsBundle.js"></script>
</body>

</html>