
const emailValidationII = document.getElementById('email-validation-II');
const passwordValidationII = document.getElementById('password-validation-II');

const emailFieldII = document.getElementById('email-II');
const passwordFieldII = document.getElementById('password-II');


emailFieldII.addEventListener("input", () => {
	if (emailFieldII.validity.typeMismatch || emailFieldII.value === "") {
		emailValidationII.classList.add("text-red-600");
		emailValidationII.classList.remove("text-green-600");
		emailFieldII.setCustomValidity("Enter a Valid Email Address");
	} else {
		emailValidationII.classList.add("text-green-500");
		emailValidationII.classList.remove("text-red-600");
		emailFieldII.setCustomValidity("");
	}
});


passwordFieldII.addEventListener("input", () => {
	if (passwordFieldII.validity.patternMismatch || passwordFieldII.value === "") {
		passwordValidationII.classList.add("text-red-600");
		passwordValidationII.classList.remove("text-green-500");
		passwordFieldII.setCustomValidity(
			"Password Must be Minimum eight characters, at least one letter , one number and one special character "
		);
	} else {
		passwordValidationII.classList.add("text-green-500");
		passwordValidationII.classList.remove("text-red-600");
		passwordFieldII.setCustomValidity("");
	}
});