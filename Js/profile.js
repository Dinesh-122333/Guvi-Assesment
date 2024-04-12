$(document).ready(function() {
    var email = localStorage.getItem('userEmail');

    if (email) {
        $.ajax({
            url: './php/profile.php',
            method: 'GET',
            data: { email: email },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    var userData = response.data;
                    $('#firstName').val(userData.Firstname);
                    $('#lastName').val(userData.Lastname);
                    $('#email').val(userData.Email);
                    $('#phone').val(userData["Phone Number"]);
                    $('#dob').val(userData["Date of Birth"]);
                    $('#city').val(userData.City);
                    $('#age').val(userData.Age);
                } else {
                    console.error('Error retrieving data:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
                window.alert("An error occurred while retrieving user data.");
            }
        });
    } else {
        console.error('Email not found in local storage.');
    }

    var updateForm = $('#updateForm');
    if (updateForm.length) {
        updateForm.on('submit', function(e) {
            e.preventDefault();
            var formData = {
                firstName: $("#firstName").val(),
                lastName: $("#lastName").val(),
                email: $("#email").val(),
                dob: $("#dob").val(),
                age: $("#age").val(), 
                city: $("#city").val(),
                phone: $("#phone").val(),
            };
            // var formData = new FormData(this);
            console.log(formData)
            $.ajax({
                method: 'POST',
                url: './assets/update.php',
                data: formData,
                success: function(data) {
                    console.log(data);
                    var responseData = JSON.parse(data);
                    if (responseData.status === "success") {
                        window.alert("Profile updated successfully");
                    } else {
                        window.alert("Failed to update profile: " + responseData.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    window.alert("An error occurred while updating profile.");
                }
            });
        });
    } else {
        console.error("Update form not found. Make sure the element with ID 'updateForm' exists in your HTML.");
    }
});
