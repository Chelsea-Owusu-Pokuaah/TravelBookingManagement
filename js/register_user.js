function registerUser(e) {
    var password = document.getElementById('password').value;
    var passwordRetype = document.getElementById('retypePassword').value;

    var nameRegex = /^[A-Za-z]+$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var phoneRegex = /^\+?\d{12}$/;
    var dobRegex = /^\d{4}-\d{2}-\d{2}$/;
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

    if (password != passwordRetype) {
        alert("Invalid password. Password must be the same as the one typed.");
        e.preventDefault();
        return false;
    } else if (!nameRegex.test(document.forms["register_user"]["firstName"].value)) {
        alert("Enter a valid first name.");
        e.preventDefault();
        return false;
    } else if (!nameRegex.test(document.forms["register_user"]["lastName"].value)) {
        alert("Enter a valid last name.");
        e.preventDefault();
        return false;
    } else if (!emailRegex.test(document.forms["register_user"]["email"].value)) {
        alert("Invalid email address.");
        e.preventDefault();
        return false;
    } else if (!dobRegex.test(document.forms["register_user"]["dob"].value)) {
        alert("Invalid date of birth.");
        e.preventDefault();
        return false;
    } else if (!phoneRegex.test(document.forms["register_user"]["phoneNumber"].value)) {
        alert("Invalid phone number.");
        e.preventDefault();
        return false;
    } else if (!passwordRegex.test(document.forms["register_user"]["password"].value)) {
        alert("Invalid password. Password must contain at least 8 characters, one uppercase letter, one lowercase letter, and one digit.");
        e.preventDefault();
        return false;
    } else {
        return true;
    }
}

