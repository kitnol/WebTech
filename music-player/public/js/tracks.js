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
function fadeOut(container,length,aX,aY,scale,enmov){
    if (container) { // fadeou animation
        const rect = container.getBoundingClientRect();
        const elX = (rect.left+rect.right)/2;
        const elY = (rect.top+rect.bottom)/2;
        const dX = (elX-aX)*enmov;
        const dY = (elY-aY)*enmov;
        container.style.transition = 'opacity '+length+'s ease-out, transform '+length+'s ease-out';
        container.style.opacity = '0';
        container.style.transform = 'translateX('+dX+'px) translateY('+dY+'px) scale('+scale+','+scale+')';
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const topinfo = document.getElementById('top-info');
    const container = document.querySelectorAll('.groupedfield');
    fadeIn(topinfo,100,0.3);
   for (const [i,element] of container.entries()){
        fadeIn(element,400+i*100,0.5);
    }
    const cards = document.querySelectorAll('.card');
    const buttons = document.querySelectorAll('.cardtext');
    for (const [i,element] of buttons.entries()){
        element.addEventListener('click', function() {
            const rect = cards[i].getBoundingClientRect();
            const elX = (rect.left+rect.right)/2;
            const elY = (rect.top+rect.bottom)/2;
            console.log(elX);
            console.log(elY);
            for (const [j,cardel] of cards.entries()){
                if (i==j){
                    fadeOut(cardel,0.8,elX,elY,2,0);
                }else{
                fadeOut(cardel,0.3,elX,elY,0.8,1);
                }
            }
            for (const [k,contel] of container.entries()){
                if (contel.contains(element)){
                    fadeOut(contel,0.8,elX,elY,1.2,0);
                }else{ 
                    fadeOut(contel,0.3,elX,elY,0.8,1);
                }
            }
            fadeOut(topinfo,0.1,elX,elY,1,1);
        });
    }
    const plays = document.querySelectorAll('.play-link');
    for (const [i,element] of plays.entries()){
        element.addEventListener('click', function() {
            const rect = cards[i].getBoundingClientRect();
            const elX = (rect.left+rect.right)/2;
            const elY = (rect.top+rect.bottom)/2;
            console.log(elX);
            console.log(elY);
            for (const [j,cardel] of cards.entries()){
                if (i==j){
                    fadeOut(cardel,0.8,elX,elY,2,0);
                }else{
                fadeOut(cardel,0.3,elX,elY,0.8,1);
                }
            }
            for (const [k,contel] of container.entries()){
                if (contel.contains(element)){
                    fadeOut(contel,0.8,elX,elY,1.2,0);
                }else{ 
                    fadeOut(contel,0.3,elX,elY,0.8,1);
                }
            }
            fadeOut(topinfo,0.1,elX,elY,1,1);
        });
    }
});