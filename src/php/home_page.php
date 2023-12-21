<?php
// Check if the button is clicked
if (isset($_POST['submit'])) {
    // Redirect to another PHP page
    header('Location: authentication.php');
    exit(); // Make sure to stop the script after the header to avoid potential issues
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/eb2112263c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/main.css">
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
    <title>Dental-Smile</title>
</head>

<body>
    <nav id="nav" class="bg-white w-full border-gray-200 dark:bg-gray-900 shadow-xl fixed">
        <div class="w-full flex items-center justify-between p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../assets/logo.png" class="h-8 hover:animate-spin" alt="" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"> Dental &nbsp<span class="text-blue-600">Smile</span></span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#home" class="block py-2 px-3 text-gray-900 rounded md:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#services" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                    </li>
                    <li>
                        <a href="#about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
                    </li>
                    <li>
                        <a href="#contact" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div>
                <!-- Hamburger Icon -->
                <button id="menu-btn" class="hamburger p-5 mt-6 md:hidden focus:outline-none">
                    <span class="hamburger-top bg-black dark:bg-white"></span>
                    <span class="hamburger-middle bg-black dark:bg-white"></span>
                    <span class="hamburger-bottom bg-black dark:bg-white"></span>
                </button>

                <!-- Dark Mode Button (outside hamburger button) -->
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:animate-spin focus:outline-none rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>



        </div>
        <!-- Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div id="menu" class="rounded-lg flex-col items-center hidden self-end py-8 mt-10 space-y-6 font-bold sm:w-auto sm:self-center left-6 right-6 drop-shadow-md">
                <a href="#home" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
                <a href="#services" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                <a href="#about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
                <a href="#contact" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact Us</a>

            </div>
        </div>
    </nav>

    <!-- Home -->
    <section id="home" class="h-[100vh] flex items-center justify-between bg-white dark:bg-gray-900 shadow-2xl">
        <div class="flex-1 text-center px-4">
            <div class="text-7xl font-bold text-gray-800 dark:text-white mb-4 text-center">Welcome to <br><span class="text-blue-500">Dental Smile</span></div>
            <h3 class="text-lg text-gray-600 dark:text-gray-300 mb-8">Creating Healthy <br>Beautiful Smiles for Life</h3>
            <form method="POST">
                <button id="getStartedButton" type="submit" name="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Get Started Now</button>
            </form>
        </div>
        <img></div>
        <div class="main-bg-style flex-2 h-full w-[60%] hidden md:flex">
            <img id="main-bg" class="main-bg-style rounded-l-xl" src="../assets/main-bg-dark.jpg">
        </div>
    </section>
    <!-- service -->
    <section id="services" class="pt-6 bg-white dark:bg-gray-900 md:h-screen">
        <div class=" py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6 dark:bg-gray-900">
            <div class=" max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">What we offer to take care of your teeth</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">At Dental Smile, we are dedicated to providing you with exceptional dental care to ensure the health and beauty of your smile. Our comprehensive range of services is designed to meet all your dental needs, and our experienced team is committed to delivering personalized, high-quality care.</p>
            </div>
            <div class="pt-6 space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0 dark:bg-gray-900">
                <div>
                    <div class="bg-blue-200 flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900 dark:bg-white">
                        <img src="../assets/polish.png" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white dark:bg-gray-900">Polishing</h3>
                    <p class="text-gray-500 dark:text-gray-400">Smoothing and polishing the tooth surfaces to reduce surface stains and create a clean, refreshed feeling.</p>
                </div>
                <div>
                    <div class="bg-blue-200 flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900 dark:bg-white">
                        <img src="../assets/implant.png" class="w-8 h-8 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white dark:bg-gray-900">Implant</h3>
                    <p class="text-gray-500 dark:text-gray-400">Consultation: A thorough examination and discussion of your oral health and treatment goals.
                        Surgical placement of the implant into the jawbone. This is a minor surgical procedure performed with precision and care.</p>
                </div>
                <div>
                    <div class="bg-blue-200  flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900 dark:bg-white">
                        <img src="../assets/orthodontic.png" class="w-10 h-10 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Orthodontic</h3>
                    <p class="text-gray-500 dark:text-gray-400">Discreet and removable clear aligners for a more flexible and aesthetically pleasing orthodontic experience.

                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--- 3 Cards-->
    <div class="hidden justify-center space-y-9 p-4 sm:flex-row sm:space-x-8 sm:space-y-0 dark:bg-gray-900 md:flex">
        <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5 dark:bg-gray-900">
            <!--Card 1-->
            <div class="rounded overflow-hidden dark:text-white shadow-lg dark:bg-gray-900">
                <img class="w-full" src="../assets/boy-dental-exam.jpeg" alt="Mountain">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Early Orthodontic Evaluation</div>
                    <p class="text-gray-700 dark:text-white text-base">
                        Assessing the need for orthodontic treatment.
                        Early intervention for alignment issues. </p>
                </div>
            </div>
            <!--Card 2-->
            <div class="rounded overflow-hidden shadow-lg dark:text-white dark:bg-gray-900">
                <img class="w-full" src="../assets/primary-school-boy-having-examination-iStock-639115580-scaled.jpg" alt="River">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Preventive Dentistry</div>
                    <p class="text-gray-700 dark:text-white text-base">
                        Dental cleanings to remove plaque and tartar.
                        Application of fluoride to strengthen tooth enamel.
                        Dental sealants to protect against cavities.
                    </p>
                </div>
            </div>
            <!--Card 3-->
            <div class="rounded overflow-hidden shadow-lg dark:text-white dark:bg-gray-900">
                <img class="w-full" src="../assets/Children’s-Dental.jpg" alt="Forest">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2"> Pediatric Dental Examinations
                    </div>
                    <p class="text-gray-700 dark:text-white text-base">
                        Regular checkups to monitor oral development.
                        Assessments of tooth eruption and bite alignment. </p>
                </div>

            </div>
        </div>
    </div>
    <!--About us-->
    <section id="about" class="pt-12 bg-blue-300 dark:bg-gray-900">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <img class="h-full rounded-lg bg-contain hidden md:block" src="../assets/Healthnet-146-HDR-Pano-scaled.jpg" alt="office content 1">
            <div class="py-8 px-4 mx-auto max-w-screen-xl">
                <div class="text-gray-700 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Who we are ... ?</h2>
                    <p class="mb-4 font-black">Welcome to Dental Smile, where your oral health is our top priority. We are a dedicated team of dental professionals committed to providing high-quality dental care in a warm and welcoming environment.
                        At our clinic, we understand the importance of a healthy and beautiful smile, and we strive to make every visit a positive experience.</p>
                    <br>
                    <p class="font-black">Our mission is to enhance the oral health and overall well-being of our patients by delivering personalized and comprehensive dental care. We aim to build long-lasting relationships with our patients based on trust, transparency, and exceptional service.</p>
                </div>
            </div>
        </div>
    </section>

    </section>
    <!-----here is the footer -->
    <footer id="contact" class="h-screen flex flex-col justify-between pt-24 p-4 py-6  bg-white dark:bg-gray-900 ">
        <div class="flex flex-col justify-between items-center pt-32 px-5 md:flex-row">
            <div class="mb-6 md:mb-0">
                <a href="#" class="flex items-center">
                    <img src="../assets/logo.png" class="h-8 me-3" alt="FlowBite Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Clinic Contact </span>
                </a>
            </div>
            <div class="flex gap-3 grid-cols-1 sm:grid-cols-2">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white"><img src="../assets/phone-call.png " class="h-5 w-5"></h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline"><img src="../assets/email.png" class="h-5 w-5"></a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline"><img src="../assets/location.png" class="h-5 w-5"></a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">+0334544544</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="https://github.com/themesberg/flowbite" class="hover:underline ">dentalsmile.info</a>
                        </li>
                        <li>
                            <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Alex,Bee</a>
                        </li>
                    </ul>
                </div>
            </div>
            <img src="../assets/logo.png" class="w-[5rem] md:hidden p-5" />
        </div>

        <div class="hidden items-center justify-around md:flex">
            <img src="../assets/logo.png" class="w-[5rem] animate-bounce" />
            <img src="../assets/logo.png" class="w-[5rem] animate-bounce" />
            <img src="../assets/logo.png" class="w-[5rem] animate-bounce" />
            <img src="../assets/logo.png" class="w-[5rem] animate-bounce" />
            <img src="../assets/logo.png" class="w-[5rem] animate-bounce" />
        </div>

        <div class="flex items-center justify-center">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Dental Smile</a>. All Rights Reserved.
            </span>
        </div>
    </footer>

    <a href="#home">
        <button class="fixed bottom-2 right-2 z-10 bg-blue-500 text-white px-4 py-3 rounded-full dark:bg-blue-700">
            <i class="fa-solid fa-house"></i> </button></a>
    <script>
        const btn = document.getElementById('menu-btn')
        const nav = document.getElementById('menu')

        btn.addEventListener('click', () => {
            btn.classList.toggle('open')
            nav.classList.toggle('flex')
            nav.classList.toggle('hidden')
        })
    </script>
</body>

</html>