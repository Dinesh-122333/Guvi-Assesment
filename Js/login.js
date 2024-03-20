
$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        var formData1 = {
            email: $("#email").val(),
            pwd: $("#pwd").val()
        };

        console.log(formData1);
        // connenting to login.php file
        $.ajax({
            type: 'POST',
            url: './php/login.php',
            data: formData1,
            success: function(data) {
                var datajson = JSON.parse(data);
                if (datajson["userFound"] === true || datajson["userFound"] === "true"){

                    localStorage.setItem('userEmail',JSON.stringify(datajson.userData));
                    window.location.reload();
                    window.alert("Logged In");

                }else{
                    window.alert("Invalid User Name or Password");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

