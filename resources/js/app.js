import { initializeDropzone } from './dropzone'
import Swal from 'sweetalert2';
import { inputImage, dropzoneElement, title, description, formPost, btnPost } from './elements';
import { validateBtnPost } from './functions';

document.addEventListener('DOMContentLoaded', function () {
    initializeApp();
});

function initializeApp(){
    
    // Iniciar dropzone
    if ( dropzoneElement && inputImage ) {
        initializeDropzone(dropzoneElement, inputImage); // Usa el módulo dropzone.js
    }
    
    if ( title && description && inputImage ) {
        title.addEventListener('input', validateBtnPost);
        description.addEventListener('input', validateBtnPost);
        inputImage.addEventListener('change', validateBtnPost);
    }

    if ( formPost ) {
        formPost.addEventListener('submit', () => {
            btnPost.disabled = true;
            btnPost.textContent = 'publicando...';
            btnPost.classList.add('opacity-50', 'cursor-not-allowed');
        });
    }

}