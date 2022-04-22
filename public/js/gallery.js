let titleFisrtSection = document.querySelector('.block-title span.title1');

let bgMainOverlay = document.querySelector('.bg-main-gallery .overlay');

window.onload = function(){

    bgMainOverlay.style.background = "rgb(0 0 0 / 60%)";

    titleFisrtSection.style.opacity = '1';

    
}

//Gallery

//fading in of img

let imagesElement = document.querySelectorAll('#lightgallery a');

imagesElement.forEach(function(oneImage, index){

    oneImage.style.transitionDelay = '.' + (index + 2) + 's'; 

});

// const loadBtn = document.getElementById('load-more');
// let currentItems = 10;

// loadBtn.addEventListener('click', (e) => {
//     e.preventDefault();
//     let itemGallery = [... document.querySelectorAll('#lightgallery .gallery-item')];

//     for(let i = currentItems; i < currentItems + 10; i++){
//         if(itemGallery[i]){
//             itemGallery[i].style.display = "block";
//         }
//     }

//     currentItems += 10;

//     if(currentItems >= itemGallery.length){
//         loadBtn.style.display = "none";
//     }

// });






    

  
