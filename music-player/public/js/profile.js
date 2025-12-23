function editUsername() {
    const button = document.querySelector('#username-button .button');
    button.classList.add('cancel-col');
    setTimeout(() => {
        button.innerHTML = '&#10006;';
        document.getElementById('username-button').href = 'javascript:cancelUsername()';
    }, 150);

    const info = document.getElementById('username-info');
    const edit = document.getElementById('username-edit');
    rotateOut(info,0.2);
    info.addEventListener('transitionend', function handler() {
        info.removeEventListener('transitionend', handler);
        info.classList.add('hidden');
        edit.classList.remove('hidden');
        rotateIn(edit,10,0.2);
    });
}

function cancelUsername() {
    const button = document.querySelector('#username-button .button');
    button.classList.remove('cancel-col');
    setTimeout(() => {
        button.innerHTML = '&#9998;';
        document.getElementById('username-button').href = 'javascript:editUsername()';
    }, 150);

    const info = document.getElementById('username-info');
    const edit = document.getElementById('username-edit');
    rotateOut(edit,0.2);
    edit.addEventListener('transitionend', function handler() {
        edit.removeEventListener('transitionend', handler);
        edit.classList.add('hidden');
        info.classList.remove('hidden');
        rotateIn(info,10,0.2)
    });
}

function editEmail() {
    const button = document.querySelector('#email-button .button');
    button.classList.add('cancel-col');
    setTimeout(() => {
        button.innerHTML = '&#10006;';
        document.getElementById('email-button').href = 'javascript:cancelEmail()';
    }, 150);

    const info = document.getElementById('emailname-info');
    const edit = document.getElementById('emailname-edit');
    rotateOut(info,0.2);
    info.addEventListener('transitionend', function handler() {
        info.removeEventListener('transitionend', handler);
        info.classList.add('hidden');
        edit.classList.remove('hidden');
        rotateIn(edit,10,0.2);
    });
}

function cancelEmail() {
    const button = document.querySelector('#email-button .button');
    button.classList.remove('cancel-col');
    setTimeout(() => {
        button.innerHTML = '&#9998;';
        document.getElementById('email-button').href = 'javascript:editEmail()';
    }, 150);

    const info = document.getElementById('emailname-info');
    const edit = document.getElementById('emailname-edit');
    rotateOut(edit,0.2);
    edit.addEventListener('transitionend', function handler() {
        edit.removeEventListener('transitionend', handler);
        edit.classList.add('hidden');
        info.classList.remove('hidden');
        rotateIn(info,10,0.2);
    });
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
function rotateIn(container,start,length){
    if (container) {
        container.style.opacity = '0.5';
        container.style.transform = 'rotateX(90deg)';
        container.style.transition = 'opacity '+length+'s ease-out, transform '+length+'s ease-out';
        // make animation after a the start delay
        setTimeout(() => {
            container.style.opacity = '1';
            container.style.transform = 'rotateX(0deg)';
        }, start);
    }
}
function rotateOut(container,length){
    if (container) { // fadeou animation
        container.style.transition = 'opacity '+length+'s ease-out, transform '+length+'s ease-out';
        container.style.opacity = '0.5';
        container.style.transform = 'rotateX(90deg)';
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const topinfo = document.getElementById('top-info');
    const container = document.querySelector('.card');
    fadeIn(topinfo,100,0.3);
    fadeIn(container,400,0.5);
    const passwordButton = document.getElementById('pass-button');
    if (passwordButton) {
        passwordButton.addEventListener('click', function() {
        //console.log('Password edit button pressed');
        fadeOut(container,0.35); 
        setTimeout(() => {
            fadeOut(topinfo,0.35);
        }, 200); 
        });
    }
});