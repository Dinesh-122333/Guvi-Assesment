$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        var formData1 = {
            email: $("#email").val(),
            pwd: $("#pwd").val()
        };

        console.log(formData1);
        // connecting to login.php file
        $.ajax({
            type: 'POST',
            url: './php/login.php',
            data: formData1,
            success: function(data) {
                try {
                    var datajson = JSON.parse(data);
                    if (datajson["userFound"] === true || datajson["userFound"] === "true") {
                        localStorage.setItem('userEmail',JSON.stringify(datajson.userData));
                        window.location.reload();
                        window.alert("Logged In");
                    } else {
                        window.alert("Invalid User Name or Password");
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                    window.alert("An error occurred while processing your request.");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                window.alert("An error occurred while processing your request.");
            }
        });
    });
});
