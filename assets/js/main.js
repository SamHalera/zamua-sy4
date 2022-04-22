let loaderWrapper = document.querySelector('.loader-wrapper');
let loaderWrapperImg = document.querySelector('.loader-wrapper img');

let headerElement = document.querySelector('header');
let logoContainer = document.getElementById("brand-logo");
let logoElement = document.querySelector('#brand-logo img.second');
let logoFirstElement = document.querySelector('#brand-logo img.first');
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

window.addEventListener("load", function () {

    logoContainer.style.display = "block";
    loaderWrapperImg.style.display = "none";
    loaderWrapper.style.height = "0vh";
    title.style.opacity = '1'; 

    setTimeout(function(){
       
        if(document.querySelector('.line-scroll')){
            let scroller = document.querySelector('.line-scroll');
            scrollerFadeIn(scroller);
        }
        menuElement.classList.add('fade-in');
        activeBlock.style.opacity = '1';
        activeBlock.style.left = '-6px';
        
    }, 300);
});

window.addEventListener("scroll", function () {
    //console.log(this.scrollY);

    if (this.scrollY >= 300) {
        headerElement.style.backgroundColor = "rgb(0 0 0 / 89%)";
        headerElement.style.justifyContent = "space-between";
        
        logoFirstElement.style.opacity = '0';
        if(window.screen.width < 601){
            logoFirstElement.style.transform = "translate(-300px, 10px)";
            logoElement.style.transform = "translate(-16px, -8px)";
        } else {
            logoFirstElement.style.transform = "translate(-300px, 10px)";
            logoElement.style.transform = "translate(-180px, 10px)";
        }
        
        scroolToTopElement.style.display = "block";
    }
    if (this.scrollY < 200) {
        scroolToTopElement.style.display = "none";
        headerElement.style.backgroundColor = "rgb(0 0 0 / 70%)";
        
        logoFirstElement.style.opacity = '1';

        if(window.screen.width < 601){
            logoFirstElement.style.transform = "translate(10px, 10px)";
            logoElement.style.transform = "translate(-16px, -126px)";
        } else {
            logoFirstElement.style.transform = "translate(10px, 10px)";
            logoElement.style.transform = "translate(-180px, -126px)";
        }
        // logoFirstElement.style.transform = "translate(10px, 10px)";
        
        
        //headerElement.style.justifyContent = "flex-end";

    }

});

let navPanelElement = document.getElementById('main-panel');
let navUlElement = document.querySelector('.navigation-panel ul');
let navLiElements = document.querySelectorAll('.navigation-panel-item');
let burgerElement = document.getElementById('burger-panel');
let bodyElement = document.getElementById('body');
let closeIconElement = document.getElementById('icon-container');



burgerElement.addEventListener('click', function () {
    setTimeout(function () {
        navPanelElement.style.display = "block";
    }, 100);

    navPanelElement.style.opacity = "1";
    closeIconElement.style.opacity = "1";
    navUlElement.style.opacity = "1";
    navLiElements.forEach(function(navLi, index){
        // navLi.style.opacity = "1";
        // navLi.style.transform = "translateY(15px)";
        navLi.style.transitionDelay = "." + (index + 1) + "s";
    });

});


closeIconElement.addEventListener('click', function () {

    setTimeout(function () {
        navPanelElement.style.display = "none";
    }, 300);
    navUlElement.style.opacity = "0";
    navPanelElement.style.opacity = "0";


});

navLiElements.forEach(function(navLi, index){
    navLi.style.transitionDelay = "." + (index + 1) + "s";
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
    }, 4000)
    // closeAlert.addEventListener('click', function(){

    //     alertDiv.style.opacity = "0";
        
    // });
}




