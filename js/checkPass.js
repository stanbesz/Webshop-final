function checkPass() {
    var password = document.querySelector("#password_reset");
    var confirm = document.querySelector("#confirmPassword_reset");
    if (password.value != confirm.value) {
        alert('The passwords don\'t match!');
        return false;
    } else {
        return true;
    }
}