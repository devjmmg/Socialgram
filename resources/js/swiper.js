import Swiper from 'swiper';
import 'swiper/css';

export function initializeSwiper(swp) {
    
    const swiper = new Swiper(swp, {

        spaceBetween: 10,          // Espacio entre slides en píxeles
        slidesPerView: 3,
        
        breakpoints: {             // Configuración de la vista basada en el ancho de la pantalla
            468: {
                slidesPerView: 5   // 2 slides visibles a partir de 768px de ancho de pantalla
            },
            768: {
                slidesPerView: 6   // 2 slides visibles a partir de 768px de ancho de pantalla
            },
            1024: {
                slidesPerView: 7   // 3 slides visibles a partir de 1024px de ancho de pantalla
            },
            1200: {
                slidesPerView: 8   // 4 slides visibles a partir de 1200px de ancho de pantalla
            }
        },
        
    });
    
}