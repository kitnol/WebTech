function fadeIn(container, start, length) {
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
function fadeOut(container,length,aX,aY,scale){
    if (container) { // fadeou animation
        const rect = container.getBoundingClientRect();
        const elX = (rect.left+rect.right)/2;
        const elY = (rect.top+rect.bottom)/2;
        const dX = elX-aX;
        const dY = elY-aY;
        container.style.transition = 'opacity '+length+'s ease-out, transform '+length+'s ease-out';
        container.style.opacity = '0';
        container.style.transform = 'translateX('+dX+'px) translateY('+dY+'px) scale('+scale+','+scale+')';
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const topinfo = document.getElementById('top-info');
    const cards = document.querySelectorAll('.card');
    fadeIn(topinfo,100,0.3);
    for (const [i,element] of cards.entries()){
        fadeIn(element,400+i*100,0.5);
    }
    const buttons = document.querySelectorAll('.button');
    for (const [i,element] of buttons.entries()){
        element.addEventListener('click', function() {
            const rect = cards[i].getBoundingClientRect();
            const elX = (rect.left+rect.right)/2;
            const elY = (rect.top+rect.bottom)/2;
            console.log(elX);
            console.log(elY);
            for (const [j,cardel] of cards.entries()){
                if (i==j){
                    fadeOut(cardel,0.5,elX,elY,2);
                }else{
                fadeOut(cardel,0.2,elX,elY,0.7);
                }
            }
            fadeOut(topinfo,0.1,elX,elY,1);
        });
    }
});