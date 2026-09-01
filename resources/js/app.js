import { initializeDropzone } from './dropzone'

document.addEventListener('DOMContentLoaded', function () {
    
    initializeApp();
    
});

function initializeApp(){
    
    // Dropzone
    const inputImage = document.querySelector('#inputImage');
    const dropzoneElement = document.querySelector('#dropzone');
    
    // Iniciar dropzone
    if(dropzoneElement && inputImage){
        initializeDropzone(dropzoneElement, inputImage); // Usa el módulo dropzone.js
    }
    
}
