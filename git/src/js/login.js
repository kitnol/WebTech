const loginButton = document.getElementById('login-button');

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