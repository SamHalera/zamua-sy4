let bgMainOverlay = document.querySelector('.bg-main-projects .overlay');

window.onload = function(){
    bgMainOverlay.style.background = "rgb(0 0 0 / 60%)";
    
}

// DISPLAY ONE PROJECT


let sectionAllProjects = document.querySelector('.sections-all-projects');

let containerProjectsCards = document.querySelector('.container-projects-cards');
let projectsCard = document.querySelectorAll('.project-card');
let containerProjectsToDisplay = document.querySelector('.container-projects-to-display');

let closeItems = (containerProjectsCards,sectionAllProjects, containerProject, oneProjectContent, closeProject, projectPictureToDisplay) => {
    containerProjectsCards.style.opacity ="1";
    containerProjectsCards.style.display ="flex";
    sectionAllProjects.style.marginBottom = "20rem";
    sectionAllProjects.style.paddingBottom = "2rem";

    containerProject.classList.replace('show', 'hide');
    oneProjectContent.style.opacity = '1';
    
    if(window.screen.width < 601){
        sectionAllProjects.style.marginBottom = "154rem";
        closeProject.style.top = "420px";
        projectPictureToDisplay.style.left = "1.5rem";
        
    } else if(window.screen.width > 600 && window.screen.width < 1024){
        sectionAllProjects.style.marginBottom = "24rem";
        closeProject.style.top = "427px";
        // projectPictureToDisplay.style.left = "1rem";
        
    } else {
        sectionAllProjects.style.marginBottom = "135rem";
        closeProject.style.top = "20px";
        projectPictureToDisplay.style.left = "20rem";
    }
    closeProject.style.opacity = '0';
    projectPictureToDisplay.style.opacity = "0";
}

projectsCard.forEach(function(oneProjectCard,index)  {

    
    oneProjectCard.style.transitionDelay = "." + (index + 2) + "s";
   
    oneProjectCard.addEventListener('click', function(e){

        e.stopPropagation();
        let oneProjectCardId = oneProjectCard.id;
        let containerProject = document.getElementById(oneProjectCardId + '-container');
        let projectPictureToDisplay = document.getElementById(oneProjectCardId + '-to-display');
        let oneProjectContent = document.querySelector('#' + oneProjectCardId + '-container .one-project-content')
        let closeProject = document.querySelector('.close-container');

        containerProjectsCards.style.opacity ="0";
        containerProjectsCards.style.display ="none";
        sectionAllProjects.style.marginBottom = "200rem";
        sectionAllProjects.style.paddingBottom = "25rem";

        containerProject.classList.replace('hide', 'show');
        oneProjectContent.style.opacity = '1';
        oneProjectContent.style.zIndex = '19';
        closeProject.style.opacity = '1';
        
        closeProject.style.display = 'block';
        

        projectPictureToDisplay.style.opacity = "1";

        if(window.screen.width < 601){
            sectionAllProjects.style.marginBottom = "154rem";
            closeProject.style.top = "433px";
            projectPictureToDisplay.style.left = "1rem";
            
        } else if(window.screen.width > 600 && window.screen.width < 1024){
            sectionAllProjects.style.marginBottom = "270rem";
            closeProject.style.top = "447px";
            // projectPictureToDisplay.style.left = "1rem";
            
        } 
        else {
            sectionAllProjects.style.marginBottom = "200rem";
            closeProject.style.top = "40px";
            projectPictureToDisplay.style.left = "10rem";
        }
        

        closeProject.addEventListener('click', function(){
            containerProjectsCards.style.opacity ="1";
            containerProjectsCards.style.display ="flex";
            sectionAllProjects.style.marginBottom = "20rem";
            sectionAllProjects.style.paddingBottom = "2rem";

            containerProject.classList.replace('show', 'hide');
            oneProjectContent.style.opacity = '1';
            
            if(window.screen.width < 601){
                sectionAllProjects.style.marginBottom = "154rem";
                closeProject.style.top = "420px";
                projectPictureToDisplay.style.left = "1.5rem";
                
            } else if(window.screen.width > 600 && window.screen.width < 1024){
                sectionAllProjects.style.marginBottom = "24rem";
                closeProject.style.top = "427px";
                // projectPictureToDisplay.style.left = "1rem";
                
            } else {
                sectionAllProjects.style.marginBottom = "135rem";
                closeProject.style.top = "20px";
                projectPictureToDisplay.style.left = "20rem";
            }
            closeProject.style.opacity = '0';
            projectPictureToDisplay.style.opacity = "0";
        });

        
        
    });
    
});
  

    