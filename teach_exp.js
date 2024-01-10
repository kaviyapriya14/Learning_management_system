function validateForm() {
    var selectedOption = document.querySelector('input[name="selected_option"]:checked');

    if (!selectedOption) {
        toastr.error("Please select an option.");
        return false;
    }

    return true;
}

function validateForm1() {
    var userInput = document.getElementById('user_input').value.trim();
    
    if (userInput === "") {
        toastr.error("Please enter a value for the user input.");
        return false;
    }

    return true;
}
