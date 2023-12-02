
const firstNameValidation = document.getElementById('first-name-validation');
const lastNameValidation = document.getElementById('last-name-validation');
const symptomsNameValidation = document.getElementById('symptoms-name-validation');

const firstNameField = document.getElementById('first-name');
const lastNameField = document.getElementById('last-name');
const symptomsField = document.getElementById('symptoms');

firstNameField.addEventListener("input", () => {
	if (firstNameField.validity.typeMismatch || firstNameField.value === "") {
		firstNameValidation.classList.add("text-red-600");
		firstNameValidation.classList.remove("text-green-600");
		firstNameField.setCustomValidity("Enter a Valid Email Address");
	} else {
		firstNameValidation.classList.add("text-green-500");
		firstNameValidation.classList.remove("text-red-600");
		firstNameField.setCustomValidity("");
	}
});

lastNameField.addEventListener("input", () => {
	if (lastNameField.validity.typeMismatch || lastNameField.value === "") {
		lastNameValidation.classList.add("text-red-600");
		lastNameValidation.classList.remove("text-green-600");
		lastNameField.setCustomValidity("Enter a Valid Email Address");
	} else {
		lastNameValidation.classList.add("text-green-500");
		lastNameValidation.classList.remove("text-red-600");
		lastNameField.setCustomValidity("");
	}
});

symptomsField.addEventListener("input", () => {
	if (symptomsField.validity.typeMismatch || symptomsField.value === "") {
		symptomsNameValidation.classList.add("text-red-600");
		symptomsNameValidation.classList.remove("text-green-600");
		symptomsField.setCustomValidity("Enter a Valid Email Address");
	} else {
		symptomsNameValidation.classList.add("text-green-500");
		symptomsNameValidation.classList.remove("text-red-600");
		symptomsField.setCustomValidity("");
	}
});
