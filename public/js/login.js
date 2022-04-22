let loaderWrapper = document.querySelector('.loader-wrapper');
let loaderWrapperImg = document.querySelector('.loader-wrapper img');

let headerElement = document.querySelector('header');
let logoContainer = document.getElementById("brand-logo");
let logoElement = document.querySelector('#brand-logo img.second');
let logoFirstElement = document.querySelector('#brand-logo img.first');
let alertDiv = document.querySelector('.alert');
let closeAlert = document.querySelector('.alert i');

window.addEventListener("load", function () {

    logoContainer.style.display = "block";
    loaderWrapperImg.style.display = "none";
    loaderWrapper.style.height = "0vh";
});


if(alertDiv){
    closeAlert.addEventListener('click', function(){

        alertDiv.style.opacity = "0";
        
    });
}
