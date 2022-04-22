
let bgMainOverlay = document.querySelector('.bg-main-shows .overlay');
let showItems = document.querySelectorAll('.one-show-item');

window.onload = function(){
    
    bgMainOverlay.style.background = "rgb(0 0 0 / 60%)";

}

showItems.forEach(function(oneItem,index){
    oneItem.style.transitionDelay = "." + (index + 1) + "s";
});







    

  
