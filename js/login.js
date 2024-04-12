$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        var formData1 = {
            email: $("#email").val(),
            pwd: $("#pwd").val()
        };

        // connecting to login.php file
        $.ajax({
            type: 'POST',
            url: './php/login.php',
            data: formData1,
            success: function(data) {
                console.log(data);
                var datajson = JSON.parse(data);
                console.log(datajson);
                if (datajson["success"] === true ) {
                    // Store only the ID in local storage
                    saveUser(formData1.email);
                    window.location.href = 'profile.html';

                } else {
                    window.alert("Invalid User Name or Password");
                }
            
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                window.alert("An error occurred while processing your request.");
            }
        });
    });
});
