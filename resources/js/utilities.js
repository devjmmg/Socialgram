//Función para limpiar elementos del DOM
export function clearHTML(element) {
    while (element.firstChild) {
        element.removeChild(element.firstChild); // Elimina el primer hijo
    }
}

// Función para abrir el modal
export function openModal(m) {
    m.classList.remove('-top-[100rem]', 'opacity-0', 'pointer-events-none');
    m.classList.add('top-0', 'opacity-100');
}

// Función para cerrar el modal
export function closeModal(m) {
    m.classList.remove('top-0', 'opacity-100');
    m.classList.add('-bottom-[100rem]', 'opacity-0', 'pointer-events-none');
    setTimeout( () => {
        m.classList.remove('-bottom-[100rem]', 'opacity-0', 'pointer-events-none');
        m.classList.add('-top-[100rem]', 'opacity-0', 'pointer-events-none'); 
    }, 350);
}