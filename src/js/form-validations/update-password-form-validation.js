
const oldPasswordValidation = document.getElementById('old-password-validation');
const newPasswordValidation = document.getElementById('new-password-validation');
const emailToUpdatePasswordValidation = document.getElementById('email-to-update-password-validation');

const oldPasswordField = document.getElementById('old-password-field');
const newPasswordField = document.getElementById('new-password-field');
const emailToUpdatePasswordField = document.getElementById('email-to-update-password-field');

emailToUpdatePasswordField.addEventListener("input", () => {
	if (emailToUpdatePasswordField.validity.typeMismatch || emailToUpdatePasswordField.value === "") {
		emailToUpdatePasswordValidation.classList.add("text-red-600");
		emailToUpdatePasswordValidation.classList.remove("text-green-600");
		emailToUpdatePasswordField.setCustomValidity("Enter a Valid Email Address");
	} else {
		emailToUpdatePasswordValidation.classList.add("text-green-500");
		emailToUpdatePasswordValidation.classList.remove("text-red-600");
		emailToUpdatePasswordField.setCustomValidity("");
	}
});

oldPasswordField.addEventListener("input", () => {
	if (oldPasswordField.validity.patternMismatch || oldPasswordField.value === "") {
		oldPasswordValidation.classList.add("text-red-600");
		oldPasswordValidation.classList.remove("text-green-600");
		oldPasswordField.setCustomValidity(
			"Password Must be Minimum eight characters, at least one letter , one number and one special character "
		);	
    	} else {
		oldPasswordValidation.classList.add("text-green-500");
		oldPasswordValidation.classList.remove("text-red-600");
		oldPasswordField.setCustomValidity("");
    }
});


newPasswordField.addEventListener("input", () => {
	if (newPasswordField.validity.patternMismatch || newPasswordField.value === "") {
		newPasswordValidation.classList.add("text-red-600");
		newPasswordValidation.classList.remove("text-green-600");
		newPasswordField.setCustomValidity(
			"Password Must be Minimum eight characters, at least one letter , one number and one special character "
		);
	} else {
		newPasswordValidation.classList.add("text-green-500");
		newPasswordValidation.classList.remove("text-red-600");
		newPasswordField.setCustomValidity("");
	}
});