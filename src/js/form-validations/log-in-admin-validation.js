
const emailValidationIII = document.getElementById('email-validation-III');
const passwordValidationIII = document.getElementById('password-validation-III');

const emailFieldIII = document.getElementById('email-III');
const passwordFieldIII = document.getElementById('password-III');


emailFieldIII.addEventListener("input", () => {
	if (emailFieldIII.validity.typeMismatch || emailFieldIII.value === "") {
		emailValidationIII.classList.add("text-red-600");
		emailValidationIII.classList.remove("text-green-600");
		emailFieldIII.setCustomValidity("Enter a Valid Email Address");
	} else {
		emailValidationIII.classList.add("text-green-500");
		emailValidationIII.classList.remove("text-red-600");
		emailFieldIII.setCustomValidity("");
	}
});


passwordFieldIII.addEventListener("input", () => {
	if (passwordFieldIII.validity.patternMismatch || passwordFieldIII.value === "") {
		passwordValidationIII.classList.add("text-red-600");
		passwordValidationIII.classList.remove("text-green-600");
		passwordFieldIII.setCustomValidity(
			"Password Must be Minimum eight characters, at least one letter , one number and one special character "
		);
	} else {
		passwordValidationIII.classList.add("text-green-600");
		passwordValidationIII.classList.remove("text-red-600");
		passwordFieldIII.setCustomValidity("");
	}
});