import { clearHTML } from './utilities';

export function initializeFriendSearch(inputFriend, ulListResults) {

    let filterFriends = [];

    // Evento de búsqueda
    inputFriend.addEventListener('keyup', function (e) {
        loadFriends(e);
    });

    // Cargar amigos
    async function loadFriends(e) {

        const username = e.target.value;

        if (username.length >= 3) {
            const url = `/friends/${username}`;

            try {
                const response = await fetch(url);
                const friends = await response.json();
                filterFriends = friends.length > 0 ? friends : [];
                showFriends();
            } catch (error) {
                console.error('Error cargando amigos:', error);
            }

        } else {
            clearHTML(ulListResults); // Reutiliza la función del módulo utilities.js
        }
    }

    // Mostrar resultados
    function showFriends() {

        clearHTML(ulListResults); // Reutiliza la función del módulo utilities.js

        if (filterFriends && filterFriends.length > 0) {
            filterFriends.forEach(f => {
                const { username } = f;
                const li = document.createElement('LI');
                li.textContent = username;
                li.classList.add(
                    'w-11/12', 'p-4', 'rounded-lg', 'cursor-pointer', 'mx-auto', 'hover:bg-gray-200'
                );

                li.onclick = function () {
                    window.location.href = `/${username}`;
                };
                ulListResults.appendChild(li);
                
            });
            filterFriends = [];
        } else {
            // Mostrar mensaje si no hay resultados
            const noResults = document.createElement('LI');
            noResults.classList.add('text-gray-500', 'p-4');
            noResults.textContent = 'No se encontraron amigos';
            ulListResults.appendChild(noResults);
        }
    }
}
