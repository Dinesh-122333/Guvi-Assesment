document.addEventListener('DOMContentLoaded', function() {
    var userDataJSON = localStorage.getItem('userEmail');
    
    var userData = JSON.parse(userDataJSON);
    
    // sending data to profile.html
    if (userData) {
        document.getElementById('firstname').innerText =  userData.Firstname;
        document.getElementById('lastname').innerText =  userData.Lastname;
        document.getElementById('email').innerText = userData.Email;
        document.getElementById('phone').innerText = userData['Phone Number'];
    } else {
        console.error("No user data found in local storage.");
    }
});
