let alertDiv = document.querySelector('.alert');
let closeAlert = document.querySelector('.alert i');

if(alertDiv){
    closeAlert.addEventListener('click', function(){

        alertDiv.style.opacity = "0";
        
    });
}
