console.log('musica');
let titleFisrtSection = document.querySelector('.block-title span.title1');
let titleSecondSection = document.querySelector('.block-title span.title2');
let titleThirdSection = document.querySelector('.block-title span.title3');
let titleDotsSection = document.querySelector('.block-title span.title-dots');

let bgMainContainer = document.querySelector('.bg-main');
let bgMainOverlay = document.querySelector('.bg-main-music .overlay');


window.onload = function(){
    
    
    
    bgMainOverlay.style.background = "rgb(0 0 0 / 60%)";
    titleFisrtSection.style.opacity = '1';
    
    titleSecondSection.style.opacity = '1';
    
    titleThirdSection.style.opacity = '1';
    
    titleDotsSection.style.opacity = '1';
    //titleSecondSection.style.bottom = "97px";
    
}