let titleFisrtSection = document.querySelector('.block-title span.title1');
let titleFirstSectionStroke = document.querySelector('.block-title-after');
let titleSecondSection = document.querySelector('.block-title span.title2');

let bgMainOverlay = document.querySelector('.bg-bio .overlay');

window.onload = function(){

    bgMainOverlay.style.background = "rgb(0 0 0 / 60%)";
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

//Gallery

let imagesThumbnail = document.querySelectorAll('.wrapper-img img');
let imagesForModal = document.getElementsByClassName('img-modal');
let iconToLeft = document.querySelector('.el-icon-caret-left');
let iconToRight = document.querySelector('.el-icon-caret-right');



let containerModalRevealed = document.querySelector('.container-gallery-modal');
let iconSelectersContainer = document.getElementById("icon-selecters-gallery");



imagesThumbnail.forEach(function(imgThumbnail){

    imgThumbnail.addEventListener('click', function(e){

        
        let imgModal = document.querySelector("img[data-image='" + e.target.id +"']");
        
        containerModalRevealed.classList.add('container-gallery-modal-revealed');
        imgModal.style.display = "block"; 
        iconSelectersContainer.classList.remove('d-none');
        iconSelectersContainer.classList.add('d-block');

        let currentIndex = e.target.id -1;

        iconToRight.addEventListener('click', function(){

            imagesForModal[ currentIndex ].style.display = "none";

            if(currentIndex >= imagesForModal.length -1 ){
                currentIndex = -1; 

            }
            imagesForModal[ currentIndex + 1].style.display = "block";
            currentIndex ++;
        });

        iconToLeft.addEventListener('click', function(){  
            
            imagesForModal[currentIndex].style.display = "none";

            if(currentIndex === 0 ){
                currentIndex = imagesForModal.length ; 

            }
            imagesForModal[currentIndex - 1 ].style.display = "block";


            currentIndex --;
        });

        containerModalRevealed.addEventListener('click', function(e){
            imgModal.style.display = "none"; 
            iconSelectersContainer.classList.add('d-none');
            iconSelectersContainer.classList.remove('d-block');
            containerModalRevealed.classList.remove('container-gallery-modal-revealed');

            e.stopPropagation();
        });
     
    });
});





    

  
