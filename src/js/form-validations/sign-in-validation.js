
const emailValidationI = document.getElementById('email-validation-I');
const passwordValidationI = document.getElementById('password-validation-I');
const passwordConfirmationValidationI = document.getElementById('password-confirmation-validation-I');

const emailFieldI = document.getElementById('email-I');
const passwordFieldI = document.getElementById('password-I');
const passwordConfirmationFieldI = document.getElementById('confirm-password-I');


emailFieldI.addEventListener("input", () => {
	if (emailFieldI.validity.typeMismatch || emailFieldI.value === "") {
		emailValidationI.classList.add("text-red-600");
		emailValidationI.classList.remove("text-green-500");
		emailFieldI.setCustomValidity("Enter a Valid Email Address");
	} else {
		emailValidationI.classList.add("text-green-500");
		emailValidationI.classList.remove("text-red-600");
		emailFieldI.setCustomValidity("");
	}
});


passwordFieldI.addEventListener("input", () => {
	if (passwordFieldI.validity.patternMismatch || passwordFieldI.value === "") {
		passwordValidationI.classList.add("text-red-600");
		passwordValidationI.classList.remove("text-green-500");
		passwordFieldI.setCustomValidity(
			"Password Must be Minimum eight characters, at least one letter , one number and one special character "
		);
	} else {
		passwordValidationI.classList.add("text-green-500");
		passwordValidationI.classList.remove("text-red-600");
		passwordFieldI.setCustomValidity("");
	}
});
passwordConfirmationFieldI.addEventListener("input", () => {
	if (
		passwordConfirmationFieldI.value !== passwordFieldI.value ||
		passwordConfirmationFieldI.value === ""
	) {
		passwordConfirmationValidationI.classList.add("text-red-600");
		passwordConfirmationValidationI.classList.remove("text-green-500");
		passwordConfirmationFieldI.setCustomValidity("Passwords Do Not Match !");
	} else {
		passwordConfirmationValidationI.classList.add("text-green-500");
		passwordConfirmationValidationI.classList.remove("text-red-600");
		passwordConfirmationFieldI.setCustomValidity("");
	}
});

document.getElementById("form").addEventListener("submit", (e) => {
	if (
		passwordConfirmationFieldI.value !== passwordFieldI.value ||
		passwordConfirmationFieldI.value === ""
	) {
		e.preventDefault();
		passwordConfirmationValidationI.classList.add("text-red-600");
		passwordConfirmationValidationI.classList.remove("text-green-500");
		passwordConfirmationFieldI.setCustomValidity("Passwords Do Not Match !");
	}else{
		passwordConfirmationValidationI.classList.add("text-green-500");
		passwordConfirmationValidationI.classList.remove("text-red-600");
	}
});