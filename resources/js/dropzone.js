import Dropzone from "dropzone";
import Cropper from "cropperjs";
import { validateBtnPost } from "./functions";

export function initializeDropzone(dropzoneElement, inputImage) {

    let cropper = null;
    
    const cropperContainer = document.querySelector('#cropper-container');
    const cropperImage = document.querySelector('#cropper-image');
    const cropPreview = document.querySelector('#crop-preview');
    const cropPreviewContainer = document.querySelector('#crop-preview-container');
    const cut = document.querySelector('#cut');
        
    const dropzone = new Dropzone(dropzoneElement, {
        
        autoProcessQueue: false,
        url: '/',
        
        dictDefaultMessage: 'Da click o arrastra tu imagen aquí',
        acceptedFiles: '.png, .jpg, .jpeg, .webp, .avif',
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar imagen',
        maxFiles: 1,
        uploadMultiple: false,
        
        dictMaxFilesExceeded: 'No puedes subir más de una imagen',
        dictFileTooBig: 'El archivo es demasiado grande.',
        dictCancelUpload: 'Cancelar',
        dictCancelUploadConfirmation: '¿Estás seguro de que quieres cancelar esta subida?',
        dictUploadCanceled: 'Cancelada.',
        
    });

        
    dropzone.on('addedfile', function (file) {

        if (dropzone.files.length > 1) {
            dropzone.removeFile(file);
            return;
        }
        
        cut.disabled = false;
        cut.classList.remove('opacity-50', 'cursor-not-allowed');
        
        const imageURL = URL.createObjectURL(file);
        
        cropperImage.src = imageURL;
        cropperContainer.classList.remove( 'hidden' );
        cropPreviewContainer.classList.add( 'hidden' );
        
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        
        cropper = new Cropper( cropperImage, {
            template: `
                <cropper-canvas background>
                    <cropper-image
                        rotatable
                        scalable
                        skewable
                        translatable
                    ></cropper-image>
                    <cropper-shade hidden></cropper-shade>
                    <cropper-handle
                        action="select"
                        plain
                    ></cropper-handle>
                    <cropper-selection
                        initial-coverage="1"
                        aspect-ratio="1"
                        movable
                        resizable
                    >
                        <cropper-grid
                            role="grid"
                            covered
                        ></cropper-grid>
                        <cropper-crosshair
                            centered
                        ></cropper-crosshair>
                        <cropper-handle
                            action="move"
                            theme-color="rgba(255, 255, 255, 0.35)"
                        ></cropper-handle>
                        <cropper-handle
                            action="n-resize"
                        ></cropper-handle>
                        <cropper-handle
                            action="e-resize"
                        ></cropper-handle>
                        <cropper-handle
                            action="s-resize"
                        ></cropper-handle>
                        <cropper-handle
                            action="w-resize"
                        ></cropper-handle>
                        <cropper-handle
                            action="ne-resize"
                        ></cropper-handle>
                        <cropper-handle
                            action="nw-resize"
                        ></cropper-handle>
                        <cropper-handle
                            action="se-resize"
                        ></cropper-handle>
                        <cropper-handle
                            action="sw-resize"
                        ></cropper-handle>
                    </cropper-selection>
                </cropper-canvas>
            `
        });
        const canvas = cropperContainer.querySelector( 'cropper-canvas' );
        canvas.style.width = '100%';
        canvas.style.height = '100%';
    });
        
    if (cut) {
        
        cut.addEventListener( 'click', async function () {
            
            if (!cropper) {
                return;
            }
            
            const selection = cropper.getCropperSelection();
            
            if (!selection) {
                return;
            }
            
            const file = dropzone.files[0];
            
            if (!file) {
                return;
            }
            
            const previewCanvas =  await selection.$toCanvas();
            
            cropPreview.src = previewCanvas.toDataURL( 'image/png' );
            cropPreviewContainer.classList.remove( 'hidden' );
            
            const cropperImageElement = cropper.getCropperImage();

            // const imageRect = cropperImageElement.getBoundingClientRect();

            const selectionRect = selection.getBoundingClientRect();

            const transform = cropperImageElement.$getTransform();

            const scaleX = Math.abs(transform[0]);
            const scaleY = Math.abs(transform[3]);

            const outputWidth = Math.round(selectionRect.width / scaleX);
            const outputHeight = Math.round(selectionRect.height / scaleY);

            const finalCanvas = await selection.$toCanvas({
                width: outputWidth,
                height: outputHeight
            });

            const mimeType = file.type;
            const fileName = file.name;
            
            finalCanvas.toBlob( async function (blob) {
                
                if (!blob) {
                    console.error( 'No se pudo generar el recorte.' );
                    return;
                }

                const cropperFile = new File([blob], fileName, {
                    type: mimeType
                });

                const dt = new DataTransfer();
                dt.items.add(cropperFile);
                inputImage.files = dt.files;

                validateBtnPost();
                
            }, mimeType, 0.95 );
        });
    }

    dropzone.on( 'removedfile', async function () {

        if (dropzone.files.length > 0 ) {
            return;
        }

        cut.disabled = true;
        cut.classList.add( 'opacity-50', 'cursor-not-allowed' );
        
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        
        cropperImage.src = '';
        
        inputImage.value = '';
        cropPreview.src = '';
        cropPreviewContainer.classList.add('hidden');

        cropperImage.classList.add('hidden');
        cropperContainer.classList.add('border', 'border-gray-300');

        validateBtnPost();

    });

    dropzone.on('maxfilesexceeded', function (file) {
        dropzone.removeFile(file);
    });

}