import { initializeDropzone } from './dropzone'
import { clearHTML, openModal, closeModal } from './utilities';
import { initializeFriendSearch } from './searchFriends';
import { initializeSwiper } from './swiper';
import { toggleNotification } from './notification';

document.addEventListener('DOMContentLoaded', function () {
    
    initializeApp();
    
});

function initializeApp(){
    
    // HTML 
    const html = document.querySelector('html');
    const body = document.body;
    
    // Modal Friend
    const modalFriend = document.querySelector('#modalFriend');
    const btnOpenModalFriend = document.querySelector('#btnOpenModalFriend');
    const btnCloseModalFriend = document.querySelector('#btnCloseModalFriend');
    const inputFriend = document.querySelector('#inputFriend');
    const ulListResults = document.querySelector('#ulListResults');
    
    // Dropzone
    const inputImage = document.querySelector('#inputImage');
    const dropzoneElement = document.querySelector('#dropzone');
    
    //Swiper
    const swp = document.querySelector('.swiper');
    
    //Notificaciones
    const notification = document.querySelector('#notification');
    const notificationFollowers = document.querySelector('#notificationFollowers');
    
    const friendRequests = document.querySelector('#friendRequests');
    const notificationFriendRequests = document.querySelector('#notificationFriendRequests');
    
    // Abrir modal friend
    if(btnOpenModalFriend && inputFriend && ulListResults && modalFriend && html && body) {
        btnOpenModalFriend.addEventListener('click', function() {
            
            inputFriend.value = '';
            clearHTML(ulListResults);
            inputFriend.focus();
            
            openModal(modalFriend);
            html.classList.remove('scrollbar-thin');
            body.style.overflow = "hidden";
        });
    }
    
    // Cerrar modal friend
    if(btnCloseModalFriend && modalFriend && html && body) {
        btnCloseModalFriend.addEventListener('click', (e) => {
            closeModal(modalFriend);
            html.classList.add('scrollbar-thin');
            body.style.overflow = "";
        });
    }
    
    // Iniciar dropzone
    if(dropzoneElement && inputImage){
        initializeDropzone(dropzoneElement, inputImage); // Usa el módulo dropzone.js
    }
    
    // Inicializar búsqueda de amigos
    if (inputFriend && ulListResults) {
        initializeFriendSearch(inputFriend, ulListResults); // Usa el módulo searchFriends.js
    }
    
    if(swp){
        initializeSwiper(swp); // Usa el módulo swiper.js
    }
    
    if(notification && notificationFollowers){
        toggleNotification(notification, notificationFollowers, [notificationFriendRequests]); //Usa el módulo notification
    }
    
    if(friendRequests && notificationFriendRequests){
        toggleNotification(friendRequests, notificationFriendRequests, [notificationFollowers]); //Usa el módulo notification
    }
    
}
