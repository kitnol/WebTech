function editUsername() {
    document.getElementById('username-info').style.display = 'none';
    document.getElementById('username-edit').style.display = '';
}

function cancelUsername() {
    document.getElementById('username-edit').style.display = 'none';
    document.getElementById('username-info').style.display = '';
}
function editEmail() {
    document.getElementById('emailname-info').style.display = 'none';
    document.getElementById('emailname-edit').style.display = '';
}

function cancelEmail() {
    document.getElementById('emailname-edit').style.display = 'none';
    document.getElementById('emailname-info').style.display = '';
}

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
function fadeOut(container,length){
    if (container) { // fadeou animation
        container.style.transition = 'opacity '+length+'s ease-out, transform '+length+'s ease-out';
        container.style.opacity = '0';
        container.style.transform = 'translateY(50px)';
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const topinfo = document.getElementById('top-info');
    const crd = document.getElementById('card-container');
    crd.style.opacity = '1';
    const container = document.querySelector('.card');
    const closebtn = document.getElementById('closebtn');
    
    fadeIn(topinfo,100,0.3);
    fadeIn(container,300,0.3);
    fadeIn(closebtn,500,0.3);
    
    if (closebtn) {
        closebtn.addEventListener('click', function() {
        //console.log('Password edit button pressed');
        fadeOut(closebtn,0.35); 
        
        setTimeout(() => {
            fadeOut(container,0.35);
        }, 200); 
        setTimeout(() => {
            fadeOut(topinfo,0.35);
        }, 400); 
        });
    }
    
});

/* This is for checking the current password before submitting chages -->*/
document.addEventListener("DOMContentLoaded", () => {
    const currentPasswordInput = document.getElementById("current_password");

    currentPasswordInput.addEventListener("blur", function () {
        const password = this.value;

        if (password.length === 0) return;

        fetch("/check-password", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ password: password })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.valid) {
                this.classList.add("input-error");
                showErrorMessage("Current password is incorrect.");
            } else {
                this.classList.remove("input-error");
                clearErrorMessage();
            }
        });
    });
});

function showErrorMessage(msg) {
    const errorBox = document.getElementById("inline-error");
    errorBox.textContent = msg;
    errorBox.style.display = "block";
}

function clearErrorMessage() {
    const errorBox = document.getElementById("inline-error");
    errorBox.textContent = "";
    errorBox.style.display = "none";
}

/* <-- */