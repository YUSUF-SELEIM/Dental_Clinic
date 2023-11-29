
const emailValidation = document.getElementById('email-validation');
const passwordValidation = document.getElementById('password-validation');
const passwordConfirmationValidation = document.getElementById('password-confirmation-validation');

const emailField = document.getElementById('email-I');
const passwordField = document.getElementById('password-I');
const passwordConfirmationField = document.getElementById('confirm-password-I');


emailField.addEventListener("input", () => {
	if (emailField.validity.typeMismatch || emailField.value === "") {
		emailValidation.classList.add("text-red-600");
		emailValidation.classList.remove("text-green-600");
		emailField.setCustomValidity("Enter a Valid Email Address");
	} else {
		emailValidation.classList.add("text-green-500");
		emailValidation.classList.remove("text-red-600");
		emailField.setCustomValidity("");
	}
});


passwordField.addEventListener("input", () => {
	if (passwordField.validity.patternMismatch || passwordField.value === "") {
		passwordValidation.classList.add("text-red-600");
		passwordValidation.classList.remove("text-green-600");
		passwordField.setCustomValidity(
			"Password Must be Minimum eight characters, at least one letter , one number and one special character "
		);
	} else {
		passwordValidation.classList.add("text-green-600");
		passwordValidation.classList.remove("text-red-600");
		passwordField.setCustomValidity("");
	}
});
passwordConfirmationField.addEventListener("input", () => {
	if (
		passwordConfirmationField.value !== passwordField.value ||
		passwordConfirmationField.value === ""
	) {
		passwordConfirmationValidation.classList.add("text-red-600");
		passwordConfirmationValidation.classList.remove("text-green-600");
		passwordConfirmationField.setCustomValidity("Passwords Do Not Match !");
	} else {
		passwordConfirmationValidation.classList.add("text-green-600");
		passwordConfirmationValidation.classList.remove("text-red-600");
		passwordConfirmationField.setCustomValidity("");
	}
});

document.getElementById("form").addEventListener("submit", (e) => {
	if (
		passwordConfirmationField.value !== passwordField.value ||
		passwordConfirmationField.value === ""
	) {
		e.preventDefault();
		passwordConfirmationValidation.classList.add("text-red-600");
		passwordConfirmationValidation.classList.remove("text-green-600");
		passwordConfirmationField.setCustomValidity("Passwords Do Not Match !");
	}else{
		passwordConfirmationValidation.classList.add("text-green-600");
		passwordConfirmationValidation.classList.remove("text-red-600");
	}
});