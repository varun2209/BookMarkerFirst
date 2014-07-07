$(document).ready(function () {
    $("#registerform").submit(function (event) {

        // Stop form from submitting normally
        event.preventDefault();

        // Get some values from elements on the page:
        var $form = $(this);
        var user = $form.find("input[name='username']").val();
        var password = $form.find("input[name='passcode']").val();
        var confirmpassword = $form.find("input[name='confirmpasscode']").val();
        var userRegex = new RegExp('[^a-zA-Z0-9_@]');
        var passwordRegex = new RegExp('[^a-zA-Z0-9]');
        var url = $form.attr("action");
        //checking the input fields

        if (user.length < 8) {
            var alertmessage = "User name must be >= 8 characters.";
            $("#result").text(alertmessage);
        } else if (user.length > 12) {
            var alertmessage = "User name must be <= 12 characters.";
            $("#result").text(alertmessage);
        } else if (userRegex.test(user)) {
            var alertmessage = "Only '_' and '@' are allowed in user name.";
            $("#result").text(alertmessage);
        } else if (password.length < 8) {
            var alertmessage = "Password must be >=8 characters.";
            $("#result").text(alertmessage);
        } else if (passwordRegex.test(password)) {
            var alertmessage = "Alphanumeric characters only are allowed in password.";
            $("#result").text(alertmessage);
        } else if (!(confirmpassword === password)) {
            var alertmessage = "Passwords do not match.";
            $("#result").text(alertmessage);
        } else {
            $("#result").text('');
            // Send the data using post
            var posting = $.post(url, {
                username: user,
                passcode: password,
                confirmpasscode: confirmpassword
            });

            // Put the results in a div
            posting.done(function (data) {
                //$( "#result" ).html( data );
                if (!data) {
                    var alertmessage = "User already exists.";
                    $("#result").html(alertmessage);
                } else {
                    window.location.href = data;
                }
            });
        }

        //checking the input fields
    });
});