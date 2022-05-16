let titleFisrtSection = document.querySelector('.block-title span.title1');
let titleFirstSectionStroke = document.querySelector('.block-title-after');
let titleSecondSection = document.querySelector('.block-title span.title2');

window.onload = function(){

    titleFisrtSection.style.opacity = '1';
    titleSecondSection.style.opacity = '1';
    if(window.screen.width < 601){
        titleSecondSection.style.bottom = "6rem";
        titleFirstSectionStroke.style.width= "9.5rem";
    }else {
        titleSecondSection.style.bottom = "9.7rem";    
        titleFirstSectionStroke.style.width= "15rem";
    }
}





    

  
