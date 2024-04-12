function getUser() {
    var userEmail = localStorage.getItem('userEmail');
    if (userEmail) {
        return { loggedIn: true, email: userEmail };
    }
    return { loggedIn: false, email: null };
}

function saveUser(email) {
    localStorage.setItem('userEmail', email);
}

function logoutUser() {
    localStorage.removeItem('userEmail');
}

function updateNavigation(user) {
    var navigation = document.querySelector('.navbar ul');
    if (navigation) {
        if (user.loggedIn) {
            var dashboardItem = document.createElement('li');
            dashboardItem.classList.add("nav-item");
            dashboardItem.innerHTML = '<a id="dash" class="nav-link" style="color:sandybrown" href="./profile.html">Profile</a>';
            navigation.appendChild(dashboardItem);

            var logoutItem = document.createElement('li');
            logoutItem.classList.add("nav-item");
            logoutItem.innerHTML = '<a id="logout" class="nav-link" href="#">Logout</a>';
            navigation.appendChild(logoutItem);
            var logoutButton = document.getElementById('logout');
            if (logoutButton) {
                logoutButton.addEventListener('click', function () {
                    logoutUser();
                    window.alert("Logout Successful");
                    window.location.href = 'index.html'; // Redirect to index page after logout
                });
            }
        } else {
            var dashboardItem = document.querySelector('a[href="./profile.html"]');
            if (dashboardItem && dashboardItem.parentElement) {
                dashboardItem.parentElement.remove();
            }
            var logoutItem = document.querySelector('#logout');
            if (logoutItem && logoutItem.parentElement) {
                logoutItem.parentElement.remove();
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var user = getUser();
    updateNavigation(user);
});
