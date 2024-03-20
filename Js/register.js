
$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault();

        var formData = {
            firstname: $("#firstname").val(),
            lastname: $("#lastname").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            pwd: $("#pwd").val()
        };

        console.log(formData);

        // connecting to register.php
        $.ajax({
            type: 'POST',
            url: './php/register.php',
            data: formData,
            success: function(response) {
                console.log(response);
                if (response=="Error: Email already exists"){
                    window.alert("Email already exists");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});


