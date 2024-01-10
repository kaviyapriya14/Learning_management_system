function validateForm() {
   
    var errorMessages = document.getElementsByClassName('error-message');
    for (var i = 0; i < errorMessages.length; i++) {
        errorMessages[i].textContent = '';
    }

    if (!document.getElementById('first_name').value.trim()) {
        displayError('Please enter a value', 'first_name_error');
        return false;
    }

    if (!document.getElementById('last_name').value.trim()) {
        displayError('Please enter a value', 'last_name_error');
        return false;
    }

    var email = document.getElementById('email').value;
    var emailformat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!email.trim() || !emailformat.test(email)) {
        displayError('Please enter a valid Email address', 'email_error');
        return false;
    }

    var phoneNumber = document.getElementById('phone_number').value;
    if (!phoneNumber.trim() || !/^\d{10}$/.test(phoneNumber)) {
        displayError('Please enter a valid 10-digit Phone Number', 'phone_number_error');
        return false;
    }

    var password = document.getElementById('password').value;
    if (password.length < 8) {
        displayError('Must be at least 8 characters long', 'password_error');
        return false;
    }
   
    return true;
}

function displayError(message, containerId) {
    var container = document.getElementById(containerId);
    var errorElement = document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.textContent = message;
    container.appendChild(errorElement);
}

