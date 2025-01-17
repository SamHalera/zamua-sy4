
// DISPLAY ONE PROJECT

let sectionAllProjects = document.querySelector('.sections-all-projects');

let containerProjectsCards = document.querySelector('.container-projects-cards');
let projectsCard = document.querySelectorAll('.project-card');
let containerProjectsToDisplay = document.querySelector('.container-projects-to-display');


projectsCard.forEach(function(oneProjectCard,index)  {

    
    oneProjectCard.style.transitionDelay = "." + (index + 2) + "s";
   
    oneProjectCard.addEventListener('click', function(e){


        let scrollToPosition = oneProjectCard.offsetTop + 400;
        console.log(scrollToPosition);
        let oneProjectCardId = oneProjectCard.id;
        let containerProject = document.getElementById(oneProjectCardId + '-container');
        let projectPictureToDisplay = document.getElementById(oneProjectCardId + '-to-display');
        let oneProjectContent = document.querySelector('#' + oneProjectCardId + '-container .one-project-content')
        let closeProject = document.querySelector('.close-container');
        containerProjectsCards.style.opacity ="0";
        containerProjectsCards.style.display ="none";
        sectionAllProjects.style.marginBottom = "20rem";
        sectionAllProjects.style.paddingBottom = "25rem";
        containerProject.classList.replace('hide', 'show');
        
        setTimeout(function(){
            containerProject.classList.replace('opacity-0', 'opacity-1');
            oneProjectContent.style.opacity = '1';
            projectPictureToDisplay.style.opacity = "1";
            projectPictureToDisplay.style.left = "0rem";
            
        }, 150);
        
        
        oneProjectContent.style.zIndex = '19';
        closeProject.style.opacity = '1';
        
        closeProject.style.display = 'block';
        
        if(window.screen.width < 375){
            closeProject.style.top = "33rem";
        }
        else if(window.screen.width >= 375 && window.screen.width < 480){
            closeProject.style.top = "35rem";
        }
        else if(window.screen.width >= 480 && window.screen.width <= 640){
            
            closeProject.style.top = "40rem";
            projectPictureToDisplay.style.left = "1rem";
            
        } else if(window.screen.width > 640 && window.screen.width < 992){
            
            closeProject.style.top = "40rem";    

        } 
        else if(window.screen.width >= 992 && window.screen.width < 1400){

            closeProject.style.top = "35rem";    

        } 
        else if(window.screen.width >= 1400){

            closeProject.style.top = "6rem";    
        } 

        // else {
            
        //     closeProject.style.top = "4rem";
            
        // }
        

        closeProject.addEventListener('click', function(){
            console.log(scrollToPosition);
            oneProjectCard.offsetTop
            window.scrollTo({
                top: scrollToPosition,
                behavior: "smooth"
            });
            containerProjectsCards.style.opacity ="1";
            containerProjectsCards.style.display ="flex";
            sectionAllProjects.style.marginBottom = "20rem";
            sectionAllProjects.style.paddingBottom = "2rem";

            containerProject.classList.replace('show', 'hide');
            oneProjectContent.style.opacity = '0';
            projectPictureToDisplay.style.left = "43rem";
            

            if(window.screen.width < 375){
                closeProject.style.top = "38rem";
            }
            else if(window.screen.width >= 375 && window.screen.width < 480){
                closeProject.style.top = "40rem";
            }
            else if(window.screen.width >= 480 && window.screen.width <= 640){
            
                closeProject.style.top = "45rem";
                projectPictureToDisplay.style.left = "1rem";
                
            } 
            else if(window.screen.width > 640 && window.screen.width < 992){
                
                closeProject.style.top = "45rem";    
    
            } 
            else if(window.screen.width >= 992 && window.screen.width < 1200){
                
                closeProject.style.top = "40rem";    
    
            }
            else if(window.screen.width >= 1200 && window.screen.width < 1400){
                
                closeProject.style.top = "40rem";    
    
            }  
            else if(window.screen.width >= 1400){

                closeProject.style.top = "10rem";    
            } else {
                
                closeProject.style.top = "2rem";
                
            }

            closeProject.style.opacity = '0';
            projectPictureToDisplay.style.opacity = "0";
            
        });   
        
    });
    
});
  

    