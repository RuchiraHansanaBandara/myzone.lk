function checkPasswordMatch() {
    var password = $("#newPassword").val();
    var confirmPassword = $("#confirmPassword").val();

    if (password != confirmPassword)
        $("#passwordAlert").html("Passwords do not match!");
}

$(document).ready(function () {
   $("#confirmPassword").keyup(checkPasswordMatch);
});