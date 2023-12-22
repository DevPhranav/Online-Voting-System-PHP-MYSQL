function validateForm() {
    var password = document.querySelector('input[name="password"]').value;
    var cpassword = document.querySelector('input[name="cpassword"]').value;
    var passwordError = document.getElementById("passwordError");
    var candidateDropBox = document.querySelector('#elec'); // Corrected ID selector
    var role = document.querySelector('#user-type').value; // Corrected ID selector
       passwordError.textContent="";
    if (password !== cpassword) {
        passwordError.textContent = "Passwords do not match";
        return false;
    } else {
        passwordError.textContent = "";
        if (role === "voter") {
            candidateDropBox.removeAttribute("required");
        } else {
            candidateDropBox.setAttribute("required", "required");
        }
        return true;
    }
}
