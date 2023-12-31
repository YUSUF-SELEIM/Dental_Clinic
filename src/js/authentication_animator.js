const loginHereButton = document.getElementById('login-here');
const signInForm = document.getElementById('signin-form');
const logInForm = document.getElementById('login-form');
const adminLoginForm = document.getElementById('admin-login-form');
const updatePasswordForm = document.getElementById('update-password-form');
const updatePasswordButton = document.getElementById('update-password-button');
const backToLoginFromUpdatePassword = document.getElementById('back-to-login-from-update-password');
const backToSignin = document.getElementById('back-to-signin');
const backToLogin = document.getElementById('back-to-login');
const loginAsAdmin = document.getElementById('login-as-admin');

loginHereButton.addEventListener('click', () => {
    signInForm.classList.add("opacity-0", "transition-opacity", "duration-200");
    setTimeout(() => {
        signInForm.classList.add("hidden");
        logInForm.classList.remove("hidden");
        logInForm.classList.remove("opacity-0");
    }, 200); // Adjust the duration here (in milliseconds)
});

backToSignin.addEventListener('click', () => {
    logInForm.classList.add("opacity-0", "transition-opacity", "duration-200");
    setTimeout(() => {
        logInForm.classList.add("hidden");
        signInForm.classList.remove("hidden");
        signInForm.classList.remove("opacity-0");
    }, 200); // Adjust the duration here (in milliseconds)
});

loginAsAdmin.addEventListener('click', () => {
    logInForm.classList.add("opacity-0", "transition-opacity", "duration-200");
    setTimeout(() => {
        logInForm.classList.add("hidden");
        adminLoginForm.classList.remove("hidden");
        adminLoginForm.classList.remove("opacity-0");
    }, 200); // Adjust the duration here (in milliseconds)
});

backToLogin.addEventListener('click', () => {
    adminLoginForm.classList.add("opacity-0", "transition-opacity", "duration-200");
    setTimeout(() => {
        adminLoginForm.classList.add("hidden");
        logInForm.classList.remove("hidden");
        logInForm.classList.remove("opacity-0");
    }, 200); // Adjust the duration here (in milliseconds)
});

updatePasswordButton.addEventListener('click', () => {
    logInForm.classList.add("opacity-0", "transition-opacity", "duration-200");
    setTimeout(() => {
        logInForm.classList.add("hidden");
        updatePasswordForm.classList.remove("hidden");
        updatePasswordForm.classList.remove("opacity-0");
    }, 200); // Adjust the duration here (in milliseconds)
});
   
backToLoginFromUpdatePassword.addEventListener('click',() => {
    updatePasswordForm.classList.add("opacity-0", "transition-opacity", "duration-200");
    setTimeout(() => {
        updatePasswordForm.classList.add("hidden");
        logInForm.classList.remove("hidden");
        logInForm.classList.remove("opacity-0");
    }, 200); // Adjust the duration here (in milliseconds)
})