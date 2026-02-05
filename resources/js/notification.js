export function toggleNotification(notification, windowNotification, otherWindows = []) {
    
    notification.addEventListener('click', function(e) {
        otherWindows.forEach(w => {
            if(!w.classList.contains('hidden')){
                closeNotificacionWindow(w);
            }
        });
        
        if (windowNotification.classList.contains('hidden')) {
            openNotificacionWindow(windowNotification);
        } else {
            closeNotificacionWindow(windowNotification);
        }
    });
}

function closeNotificacionWindow(window) {
    window.classList.remove('opacity-100', 'translate-y-0');
    window.classList.add('opacity-0');
    setTimeout(() => {
        window.classList.add();
        window.classList.add('hidden','translate-y-5');
    }, 500); // Ocultar después de la animación
}

function openNotificacionWindow(window) {
    window.classList.remove('hidden');
    setTimeout(() => {
        window.classList.remove('opacity-0', 'translate-y-5');
        window.classList.add('opacity-100', 'translate-y-0');
    }, 100); // Tiempo corto para permitir que el navegador aplique la animación
}