function fadeIn(container,start,length,aX,aY,scale,enmov){
    if (container) { // fadein animation
        const rect = container.getBoundingClientRect();
        const elX = (rect.left+rect.right)/2;
        const elY = (rect.top+rect.bottom)/2;
        const dX = (elX-aX)*enmov;
        const dY = (elY-aY)*enmov;
        container.style.transition = 'opacity '+length+'s ease-out, transform '+length+'s ease-out';
        container.style.opacity = '0';
        container.style.transform = 'translateX('+dX+'px) translateY('+dY+'px) scale('+scale+','+scale+')';
        setTimeout(() => {
        container.style.opacity = '1';
        container.style.transform = 'translateX(0) translateY(0)';
        }, start);
    }
}
function fadeInCard(container, start, length) {
if (container) {
    container.style.opacity = '0';
    container.style.transform = 'translateY(50px)';
    container.style.transition = 'opacity ' + length + 's ease-out, transform ' + length + 's ease-out';
    setTimeout(() => {
    container.style.opacity = '1';
    container.style.transform = 'translateY(0)';
    }, start);
}
}
document.addEventListener('DOMContentLoaded', function () {
    const topleft = document.querySelector('.hero-image');
    const botleft = document.querySelector('.song-list');
    const topright = document.querySelector('.album-art');
    const botright = document.querySelector('.player-class');
    const cX  = document.documentElement.scrollWidth * 0.6;
    const cY = document.documentElement.scrollHeight * 0.5;
    fadeIn(topleft,120,0.5,cX,cY,0.5,1);
    fadeIn(topright,100,0.5,cX,cY,0.5,1);
    fadeIn(botleft,50,0.5,cX,cY,0.5,1);
    fadeIn(botright,200,0.5,cX,cY,0.5,1);
    const container = document.querySelectorAll('.card');
    for (const [i,element] of container.entries()){
        fadeInCard(element,600+i*120,0.5);
    }
});