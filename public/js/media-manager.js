Dropzone.autoDiscover = false;


initializeDropzone();


function initializeDropzone(){
    let formElt = document.querySelector('.js-media-dropzone');
    if(! formElt){
        return;
    }

    let dropzone = new Dropzone(formElt, {
        paramName : 'newFile',
        init: function(){
            this.on('error', function(file, data){
                if(data.detail){
                    this.emit('error', file, data.detail);
                }
            });
        }
    });
}

