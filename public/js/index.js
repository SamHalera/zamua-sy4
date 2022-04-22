let bgMainOverlay = document.querySelector('.bg-main .overlay');
let allSpanTextElement = document.querySelectorAll('.block-text h1 span');

window.onload = function(){
   
    console.log("load");
    allSpanTextElement.forEach(spanText => {
        spanText.classList.add('show-span');
    });
    
    
}
