import Dropzone from "dropzone";

export function initializeDropzone( dropzoneElement, inputImage)
{
    // Inicialización de Dropzone
    Dropzone.autoDiscover = false;
    
    const dropzone = new Dropzone(dropzoneElement, {
        dictDefaultMessage: 'Da click o arrastra tu imagen aquí',
        acceptedFiles: '.png, .jpg, .jpeg, .gif, .avif',
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar imagen',
        maxFiles: 1,
        uploadMultiple: false,
        dictMaxFilesExceeded: 'No puedes subir más de una imagen',
        
        init() {
            // Si ya existe una imagen, agregarla al preview
            const savedImage = inputImage.value.trim();
            if (savedImage) {
                const uploadImage = {
                    size: 1000,
                    name: savedImage
                };
                this.options.addedfile.call(this, uploadImage);
                this.options.thumbnail.call(this, uploadImage, `/uploads/${uploadImage.name}`);
                uploadImage.previewElement.classList.add('dz-success', 'dz-complete');
            }
        }
    });
    
    // Evento success para guardar la imagen
    dropzone.on('success', function (file, response) {
        inputImage.value = response.image;
    });
    
    // Evento removedfile para limpiar la imagen
    dropzone.on('removedfile', function () {
        inputImage.value = '';
    });
}