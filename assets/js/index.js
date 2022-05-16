let allSpanTextElement = document.querySelectorAll('.block-text h1 span');

window.onload = function(){
   
    allSpanTextElement.forEach(spanText => {
        spanText.classList.add('show-span');
    });
    
}
