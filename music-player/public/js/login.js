/*const loginButton = document.getElementById('login-button');

class Login {
    constructor() {
        loginButton.addEventListener('click', this.handleLogin);
    }

    handleLogin(event) {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        console.log(`Username: ${username}, Password: ${password}`);
        const user = logins.find(user => user[0] === username && user[1] === password);
        
        if (user) {
            alert('Login successful!');
            //window.location.href = 'profile.html';
        } else {
            alert('Invalid username or password. Please try again.');
        }
    }
}

const  logins = [
    ['admin', 'admin'],
    ['user1', 'Password123']
];

const loginInstance = new Login();
*/
// Animation for fade in the login container upwards
function fadeIn(container,start,length){
    if (container) {
        container.style.opacity = '0';
        container.style.transform = 'translateY(50px)';
        container.style.transition = 'opacity '+length+'s ease-out, transform '+length+'s ease-out';
        // make animation after a the start delay
        setTimeout(() => {
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, start);
    }
}
function fadeOut(container, length) {
    if (container) {
        container.style.transition = 'opacity ' + length + 's ease-out, transform ' + length + 's ease-out';
        container.style.opacity = '0';
        container.style.transform = 'translateY(50px)';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const topinfo = document.getElementById('top-info');
    const container = document.getElementById('card-container');
    fadeIn(topinfo,100,0.3);
    fadeIn(container,400,0.5);
    // Handle form submission with AJAX to avoid full page reload on wrong credentials and do the animation instead
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', async function (ev) {
            ev.preventDefault();
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            try {
                const response = await fetch(form.action, {method: 'POST',body: formData,headers: {'X-CSRF-TOKEN': csrfToken,'Accept': 'application/json'}});
                if (response.ok) {// login ok go home
                    const data = await response.json(); 
                    fadeOut(container,0.3);
                    setTimeout(() => {
                        fadeOut(topinfo,0.3);
                    }, 200);
                    window.location.href = data.redirect || '/home'; 
                } else {// login is not okay do the shake animation or sth...
                    const errorData = await response.json();
                    let errorMessage = 'Invalid login details, please try again'; 
                    if (errorData.errors) {
                        errorMessage = Object.values(errorData.errors).flat().join(' ');
                    }
                    // delete any previous alerts so we do not get stacking invalid details alert on top that looks ugly
                    const existingAlerts = document.querySelectorAll('.alert-danger');
                    existingAlerts.forEach(alert => alert.remove());
                    // show text at top that details are invalid  - alert
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger';
                    alertDiv.textContent = errorMessage;
                    document.querySelector('main').prepend(alertDiv);
                    // do the shake animation
                    form.classList.add('shake');
                    setTimeout(() => {
                        form.classList.remove('shake');
                    }, 500);
                }
            } catch (error) {
                console.error('Login error:', error);
                // Fallback: show generic error
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger';
                alertDiv.textContent = 'An error occurred. Please try again.';
                document.querySelector('main').prepend(alertDiv);

                form.classList.add('shake');
                setTimeout(() => {
                    form.classList.remove('shake');
                }, 500);
            }
        });
    }
});