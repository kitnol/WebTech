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
    const container = document.getElementById('card-container');
    fadeIn(topinfo,100,0.3);
    fadeIn(container,400,0.5);

    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
        //console.log('Form submitted');
        fadeOut(container,0.35); 
        setTimeout(() => {
            fadeOut(topinfo,0.35);
        }, 100);           
        });
    }
});