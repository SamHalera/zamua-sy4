
let titleFisrtSection = document.querySelector('.block-title span.title1');
let titleFirstSectionStroke = document.querySelector('.block-title-after');
let titleSecondSection = document.querySelector('.block-title span.title2');

let bgMainContainer = document.querySelector('.bg-main');
let bgMainOverlay = document.querySelector('.bg-in-my-ears .overlay');

window.onload = function(){
    
    bgMainOverlay.style.background = "rgb(0 0 0 / 60%)";
    titleFisrtSection.style.opacity = '1';
    titleSecondSection.style.opacity = '1';
    if(window.screen.width < 601){
        titleSecondSection.style.bottom = "7.3rem";
        titleFirstSectionStroke.style.width= "11rem";
    }else {
        titleSecondSection.style.bottom = "9.7rem";    
        titleFirstSectionStroke.style.width= "15rem";
    }
    
    
    
}







    

  
