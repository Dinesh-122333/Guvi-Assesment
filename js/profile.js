$(document).ready(function() {
    var updateForm = $('#updateForm');
    var emailField = $('#email');

    if (updateForm.length) {
        // Fetch user data and populate the form

        fetchUserData();

        updateForm.on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            
            // Send update request using fetch API
            $.ajax({
                url: './php/profile.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data)
                    const datas = JSON.parse(data)
                    console.log(datas); // Log the response data
                    if (datas.status === "success") {
                        if (datas.message === "Profile updated successfully") {
                            
                            window.alert("Profile updated successfully");
                            // Update form fields with new data
                            $('#firstName').val(datas.userData.Firstname);
                            $('#lastName').val(datas.userData.Lastname);
                            $('#phone').val(datas.userData["Phone Number"]);
                            $('#dob').val(datas.userData["Date of Birth"]);
                            $('#city').val(datas.userData.City);
                            $('#age').val(datas.userData.Age);
                        }
                        else  {
                            window.alert("Profile is already up to date");
                        }  
                    } else {
                        // Handle error message properly
                        var errorMessage = datas.message || "An unknown error occurred";
                        window.alert("Failed to update profile: " + errorMessage);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    window.alert("An error occurred while updating profile.");
                }
            });
        });
    } else {
        console.error("Update form not found. Make sure the element with ID 'updateForm' exists in your HTML.");
    }

    function fetchUserData() {
        // Fetch user data from database using the session variable
        $.ajax({
            url: './assets/get_user.php',
            method: 'GET',
            success: function(response) {
                try {
                    var userData = JSON.parse(response);
                    // Populate input fields with user data
                    $('#firstName').val(userData.Firstname);
                    $('#lastName').val(userData.Lastname);
                    $('#email').val(userData.Email);
                    $('#phone').val(userData["Phone Number"]);
                    $('#dob').val(userData["Date of Birth"]);
                    $('#city').val(userData.City);
                    $('#age').val(userData.Age);
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                    window.alert("An error occurred while fetching user data.");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                window.alert("An error occurred while fetching user data.");
            }
        });
    }
});
