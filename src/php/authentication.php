<?php include '../config/db.php';  ?>
<?php
$email = $password = $confirm_password = '';
$error_messenger = '';

if (isset($_POST['submit'])) {
    // Check if the 'sign-in-form' key exists in the $_POST array
    if (isset($_POST['sign-in-form']) && $_POST['sign-in-form'] == 1) {
        if (!empty($_POST['email'])) {
            $email = filter_input(
                INPUT_POST,
                'email',
                FILTER_SANITIZE_EMAIL
            );
        }

        if (!empty($_POST['password'])) {
            $password = filter_input(
                INPUT_POST,
                'password',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
        }

        if (!empty($_POST['confirm-password'])) {
            $confirm_password = filter_input(
                INPUT_POST,
                'confirm-password',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
        }

        $checkDuplicateQuery = "SELECT COUNT(*) as count FROM Users WHERE email = '$email'";
        $result = $conn->query($checkDuplicateQuery);

        if ($result && $result->fetch_assoc()['count'] > 0) {
            $error_messenger = "Email already exists. Please choose a different email.";
        } else {
            $sql = "INSERT INTO Users (email ,password) VALUES ('$email','$password')";
            if (mysqli_query($conn, $sql)) {
                // Redirect to a new page after successful form submission
                header("Location: user_page.php");
                exit(); // Make sure to exit to prevent further execution
            } else {
                echo "Error" . mysqli_error($conn);
            }
        }
    } elseif (isset($_POST['log-in-form']) && $_POST['log-in-form'] == 2) {
        if (!empty($_POST['email'])) {
            $email = filter_input(
                INPUT_POST,
                'email',
                FILTER_SANITIZE_EMAIL
            );
        }

        if (!empty($_POST['password'])) {
            $password = filter_input(
                INPUT_POST,
                'password',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
        }

        // Check if the provided credentials are valid
        $loginQuery = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($loginQuery);

        if ($result && $result->num_rows > 0) {
            header("Location: user_page.php");
            exit();
        } else {
            $error_messenger = "Invalid email or password. Please try again.";
        }
    } elseif (isset($_POST['log-in-admin-form']) && $_POST['log-in-admin-form'] == 3) {
        if (!empty($_POST['email'])) {
            $email = filter_input(
                INPUT_POST,
                'email',
                FILTER_SANITIZE_EMAIL
            );
        }

        if (!empty($_POST['password'])) {
            $password = filter_input(
                INPUT_POST,
                'password',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
        }

        // Check if the provided credentials are valid
        $loginQuery = "SELECT * FROM Admins WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($loginQuery);

        if ($result && $result->num_rows > 0) {
            header("Location: admin_page.php");
            exit();
        } else {
            $error_messenger = "Invalid email or password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/darkmode.js" defer></script>
    <script src="../js/authentication_animator.js" defer></script>
    <script src="../js/form-validations/sign-in-validation.js" defer></script>
    <script src="../js/form-validations/log-in-validation.js" defer></script>
    <script src="../js/form-validations/log-in-admin-validation.js" defer></script>
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
    <title>Dental-Clinic</title>
</head>

<body class="flex flex-col bg-gray-50 dark:bg-gray-900">

    <header class="flex justify-between items-center p-2">
        <div class="flex items-center p-2 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
            Flowbite
        </div>
        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:animate-spin focus:outline-none rounded-lg text-sm p-2.5">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </button>
    </header>

    <section id="signin-form" class="w-full flex flex-col grow items-center justify-center px-6 py-6">
        <div class="w-full  bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Create an account
                </h1>
                <form id="form" class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="hidden" name="sign-in-form" value="1">
                    <?php
                    echo '<div class = "text-red-600" >' . $error_messenger . '</div>';
                    ?>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email<span id="email-validation-I" class="text-lg text-red-600"> *</span></label>
                        <input type="email" name="email" id="email-I" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg   block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white " placeholder="john@doe.com" required>
                    </div>
                    <div>
                        <label for="password" id="password-label" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password<span id="password-validation-I" class="text-lg text-red-600"> *</span></label>
                        <input type="password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$" name="password" id="password-I" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="confirm-password" id="password-confirmation-label" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password<span id="password-confirmation-validation-I" class="text-lg text-red-600"> *</span>
                        </label>
                        <input type="confirm-password" name="confirm-password" id="confirm-password-I" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <button name="submit" class="w-full text-gray bg-gray-200 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <span id="login-here" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here </span>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <section id="login-form" class="hidden w-full flex flex-col grow items-center justify-center px-6 py-6">
        <div class="w-full  bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div class="flex space-x-4 items-center">
                    <i id="back-to-signin" class="fa fa-angle-left text-gray-900  dark:text-white" style="font-size:24px"></i>
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login
                    </h1>
                </div>
                <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="hidden" name="log-in-form" value="2">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email<span id="email-validation-II" class="text-lg text-red-600"> *</span></label>
                        <input type="email" name="email" id="email-II" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg   block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white " placeholder="john@doe.com" required>
                    </div>
                    <div>
                        <label for="password" id="password-label" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password<span id="password-validation-II" class="text-lg text-red-600"> *</span></label>
                        <input type="password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$" name="password" id="password-II" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <button name="submit" class="w-full text-gray bg-gray-200 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Login As Admin <span id="login-as-admin" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Here</span>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <section id="admin-login-form" class="hidden w-full flex flex-col grow items-center justify-center px-6 py-6">
        <div class="w-full  bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div class="flex space-x-4 items-center">
                    <i id="back-to-login" class="fa fa-angle-left text-gray-900  dark:text-white" style="font-size:24px"></i>
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login As Admin
                    </h1>
                </div>
                <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="hidden" name="log-in-admin-form" value="3">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email<span id="email-validation-III" class="text-lg text-red-600"> *</span></label>
                        <input type="email" name="email" id="email-III" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password<span id="password-validation-III" class="text-lg text-red-600"> *</span></label>
                        <input type="password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$" name="password" id="password-III" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <button type="submit" name="submit" class="w-full text-gray bg-gray-200 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>