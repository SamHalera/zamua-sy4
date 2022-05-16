//Gallery

//fading in of img

let imagesElement = document.querySelectorAll('#lightgallery a');

imagesElement.forEach(function(oneImage, index){

    oneImage.style.transitionDelay = '.' + (index + 2) + 's'; 

});








    

  
