let loaderWrapper = document.querySelector('.loader');
let loaderWrapperImg = document.querySelector('.loader-wrapper img');

let headerElement = document.querySelector('header');
let logoContainer = document.getElementById("brand-logo");
let scroolToTopElement = document.querySelector('div.scroll-to-top');

let blockTitle = document.querySelector('.block-title');
let title = document.querySelector('.block-title h1');


let menuElement = document.querySelector('.menu');
let activeBlock = document.querySelector('.active-block');



function scrollerFadeIn(scrollElt){
    return setTimeout(function(){
        
        scrollElt.classList.add('fade-in');
        
    }, 300);
}

if(document.querySelector('.line-scroll')){
    let scroller = document.querySelector('.line-scroll');
    scrollerFadeIn(scroller);
}
title.style.opacity = '1'; 
menuElement.classList.add('fade-in');
activeBlock.style.opacity = '1';
activeBlock.style.left = '-6px';


window.addEventListener("wheel", function () {



    if (this.scrollY >= 300) {
        headerElement.style.backgroundColor = "rgb(0 0 0 / 89%)";
        headerElement.style.justifyContent = "space-between";
        
        scroolToTopElement.style.display = "block";
    }
    if (this.scrollY < 200) {
        scroolToTopElement.style.display = "none";
        headerElement.style.backgroundColor = "rgb(0 0 0 / 70%)";
    }


});

let navPanelElement = document.getElementById('main-panel');
let navUlElement = document.querySelector('.navigation-panel ul');
let navLiElements = document.querySelectorAll('.navigation-panel-item');
let burgerElement = document.getElementById('burger-panel');
let bodyElement = document.getElementById('body');
let closeIconElement = document.getElementById('icon-container');
let switchLanguageMobile = document.querySelector('.switch-language.mobile-view');



burgerElement.addEventListener('click', function () {
    
    navPanelElement.style.display = "flex";
    navPanelElement.style.opacity = "1";
    closeIconElement.style.opacity = "1";
    switchLanguageMobile.style.opacity = "1";
    navLiElements.forEach(function(navLi, index){
        
        navLi.style.transitionDelay = "." + (index + 1) + "s";
        setTimeout(() => {
            navLi.style.opacity = "1";
            navLi.style.transform = "translateY(0)";
        },100);
        
    });

});
closeIconElement.addEventListener('click', function () {
    this.style.opacity = "0";
    switchLanguageMobile.style.opacity = "0";
    navLiElements.forEach(function(navLi, index){
        navLi.style.transitionDelay = "." + (index + 1) + "s";
        navLi.style.transform = "translateY(4rem)";
        navLi.style.opacity = "0";
    });
    navPanelElement.style.opacity = "0";
    navPanelElement.style.display = "none";
    
});

scroolToTopElement.addEventListener("click", function () {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    });
});

let alertDiv = document.querySelector('.alert');
let closeAlert = document.querySelector('.alert i');

if(alertDiv){

    setTimeout(function(){
        alertDiv.style.opacity = "0";
    }, 4000);
}




