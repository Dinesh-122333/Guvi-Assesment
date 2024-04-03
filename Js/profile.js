document.addEventListener('DOMContentLoaded', function() {
    var updateForm = document.getElementById('updateForm');
    var emailField = document.getElementById('email');
    
    if (updateForm) {
        // Fetch user data and populate the form
        fetchUserData();

        updateForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(updateForm);
            
            // Send update request using fetch API
            fetch('./php/update.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.alert("Profile updated successfully");
                    // Fetch and update user data after successful update
                    fetchUserData();
                } else {
                    window.alert("Failed to update profile");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    } else {
        console.error("Update form not found");
    }

    function fetchUserData() {
        // Fetch user data from database
        fetch('./php/get_user.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Populate form fields with user data
                document.getElementById('firstName').value = data.user.Firstname;
                document.getElementById('lastName').value = data.user.Lastname;
                document.getElementById('email').value = data.user.Email;
                document.getElementById('phone').value = data.user.PhoneNumber;
            } else {
                console.error("Failed to fetch user data");
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
