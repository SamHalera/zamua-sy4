//Intersection Observer
const ratio = .1;

let options = {
    root: null,
    rootMargin: '0px',
    threshold: .1
  }
  
  let handleIntersect = function(entries, observer){
      entries.forEach(function(entry){
          if(entry.intersectionRatio > ratio){
              entry.target.classList.add('reveal-visible');
              observer.unobserve(entry.target);
          }
          
      })
  }

let handleWidthIntersect = function(entries, observerSecond){
    entries.forEach(function(entry){
        if(entry.intersectionRatio > ratio){
            entry.target.classList.add('reveal-width-visible');
            observer.unobserve(entry.target);
        }
        
    })
}
let handleHeightIntersect = function(entries, observerSecond){
  entries.forEach(function(entry){
      if(entry.intersectionRatio > ratio){
          entry.target.classList.add('reveal-height-visible');
          observer.unobserve(entry.target);
      }
      
  })
}
  let observer = new IntersectionObserver(handleIntersect, options);
  let observerWidth = new IntersectionObserver(handleWidthIntersect, options);
  let observerHeight = new IntersectionObserver(handleHeightIntersect, options);

  let elementsToReveal= document.querySelectorAll('.reveal');
  let elementsToRevealUp = document.querySelectorAll('.reveal-up');
  let elementsToRevealDown = document.querySelectorAll('.reveal-down');

  let blockToRevealWidth= document.querySelectorAll('.reveal-width');
  let blockToRevealHeight = document.querySelectorAll('.reveal-height');
  
  elementsToReveal.forEach(function(element){
    observer.observe(element);
  });
  
  elementsToRevealUp.forEach(function(elementUp){
    observer.observe(elementUp);
  });
  elementsToRevealDown.forEach(function(elementDown){
    observer.observe(elementDown);
  });
  
  blockToRevealWidth.forEach(function(element){
    observerWidth.observe(element);
  });

  blockToRevealHeight.forEach(function(element){
    observerHeight.observe(element);
  });
