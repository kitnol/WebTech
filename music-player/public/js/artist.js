function editArtist() {
    const button = document.querySelector('#artist-button .button');
    button.classList.add('cancel-col');
    setTimeout(() => {
        button.innerHTML = '&#10006;';
        document.getElementById('artist-button').href = 'javascript:cancelArtist()';
    }, 150);

    const info = document.getElementById('artist-info');
    const edit = document.getElementById('artist-edit');
    rotateOut(info,0.2);
    info.addEventListener('transitionend', function handler() {
        info.removeEventListener('transitionend', handler);
        info.classList.add('hidden');
        edit.classList.remove('hidden');
        rotateIn(edit,10,0.2);
    });
}
function editPhoto() {
    const info = document.getElementById('photo-info');
    const edit = document.getElementById('photo-edit');
    rotateOut(info,0.2);
    info.addEventListener('transitionend', function handler() {
        info.removeEventListener('transitionend', handler);
        info.classList.add('hidden');
        edit.classList.remove('hidden');
        rotateIn(edit,10,0.2);
    });
}

function cancelPhoto() {
    const info = document.getElementById('photo-info');
    const edit = document.getElementById('photo-edit');
    rotateOut(edit,0.2);
    edit.addEventListener('transitionend', function handler() {
        edit.removeEventListener('transitionend', handler);
        edit.classList.add('hidden');
        info.classList.remove('hidden');
        rotateIn(info,10,0.2);
    });
}

function cancelArtist() {
    const button = document.querySelector('#artist-button .button');
    button.classList.remove('cancel-col');
    setTimeout(() => {
        button.innerHTML = '&#9998;';
        document.getElementById('artist-button').href = 'javascript:editArtist()';
    }, 150);

    const info = document.getElementById('artist-info');
    const edit = document.getElementById('artist-edit');
    rotateOut(edit,0.2);
    edit.addEventListener('transitionend', function handler() {
        edit.removeEventListener('transitionend', handler);
        edit.classList.add('hidden');
        info.classList.remove('hidden');
        rotateIn(info,10,0.2);
    });
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
    const container = document.querySelector('.card');
    const closebtn = document.getElementById('closebtn');
    const delbtn = document.getElementById('deletebtn');
    fadeIn(topinfo,100,0.3);
    fadeIn(container,300,0.3);
    fadeIn(closebtn,500,0.3);
    fadeIn(delbtn,500,0.3);
    if (closebtn) {
        closebtn.addEventListener('click', function() {
        //console.log('Password edit button pressed');
        fadeOut(closebtn,0.35);
        fadeOut(delbtn,0.35); 
        setTimeout(() => {
            fadeOut(container,0.35);
        }, 200); 
        setTimeout(() => {
            fadeOut(topinfo,0.35);
        }, 400); 
        });
    }
    if (delbtn) {
        delbtn.addEventListener('click', function() {
        //console.log('Password edit button pressed');
        fadeOut(closebtn,0.35);
        fadeOut(delbtn,0.35); 
        setTimeout(() => {
            fadeOut(container,0.35);
        }, 200); 
        setTimeout(() => {
            fadeOut(topinfo,0.35);
        }, 400); 
        });
    }
});