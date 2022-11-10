let titleFisrtSection = document.querySelector('.block-title span.title1');
let titleSecondSection = document.querySelector('.block-title span.title2');
let titleThirdSection = document.querySelector('.block-title span.title3');
let titleDotsSection = document.querySelector('.block-title span.title-dots');
let epCover = document.querySelector('.album-infos-container img.ep-js');
let epIframe = document.querySelector('.iframe-js');

window.onload = function(){
   
    titleFisrtSection.style.opacity = '1';
    
    titleSecondSection.style.opacity = '1';
    
    titleThirdSection.style.opacity = '1';
    
    titleDotsSection.style.opacity = '1';

}
epCover.addEventListener('mouseenter',() => {
        
    epIframe.classList.add('iframe-js-show');
    epIframe.addEventListener('mouseenter', ()=> {
        epIframe.classList.add('iframe-js-show');
    });
    epIframe.addEventListener('mouseleave',() => {

        epIframe.classList.remove('iframe-js-show');
    });
    
});
epCover.addEventListener('mouseleave',() => {

    epIframe.classList.remove('iframe-js-show');
});
