let allSpanTextElement = document.querySelectorAll('.block-text h1 span');
let sectionProjects = document.querySelector('.four-section-projects');
// let blur = document.querySelector('.blur');
window.onload = function(){
   
    allSpanTextElement.forEach(spanText => {
        spanText.classList.add('show-span');
    });
}




