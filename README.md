![SocialGram](/screenshots/socialgram.png)

# SocialGram

Red social desarrollada con Laravel y Livewire que permite a los usuarios compartir publicaciones, interactuar mediante likes y comentarios, responder comentarios, seguir a otros usuarios y recibir notificaciones sobre diferentes interacciones dentro de la plataforma.

El proyecto fue desarrollado como una aplicación práctica para trabajar con Laravel, Livewire, Eloquent, relaciones entre modelos, tablas pivot, paginación, infinite scroll, eventos, comunicación entre JavaScript y Livewire y procesamiento de imágenes.

## Tecnologías

* **Laravel 10**
* **Livewire 4**
* **PHP**
* **Blade**
* **Tailwind CSS**
* **MySQL**
* **Alpine.js**
* **JavaScript**
* **Vite**
* **Dropzone.js**
* **Cropper.js**
* **Swiper.js**
* **Intervention Image**
* **SweetAlert2**

## Funcionalidades

### Autenticación

* Creación de cuenta.
* Inicio de sesión.
* Cierre de sesión.
* Protección de funcionalidades para usuarios autenticados.

### Perfiles

* Perfil mediante username.
* Imagen de perfil.
* Nombre y username.
* Contador de publicaciones.
* Contador de seguidores.
* Contador de usuarios seguidos.
* Botón para seguir usuarios.
* Visualización del estado de seguimiento.
* Control de acceso a las publicaciones mediante la relación de seguimiento.

Las publicaciones de un usuario no son accesibles para cualquier visitante. Para poder visualizar las publicaciones de otro usuario es necesario tener una relación de seguimiento aceptada.

El perfil muestra la información básica del usuario, su fotografía y los contadores de seguidores, usuarios seguidos y publicaciones.

### Publicaciones

* Creación de publicaciones.
* Título y contenido.
* Carga de imágenes.
* Previsualización de imágenes.
* Recorte de imágenes antes de publicar.
* Eliminación de imágenes seleccionadas.
* Procesamiento de imágenes.
* Almacenamiento de imágenes procesadas.
* Visualización de publicaciones.
* Eliminación de publicaciones propias.
* Feed de publicaciones.

### Carga y procesamiento de imágenes

La creación de publicaciones utiliza **Dropzone.js** y **Cropper.js** para permitir seleccionar y recortar una imagen antes de enviarla al servidor.

El flujo de carga es:

```text
Seleccionar imagen
       ↓
Dropzone
       ↓
Previsualización
       ↓
Cropper.js
       ↓
Seleccionar área de recorte
       ↓
Generar imagen recortada
       ↓
Laravel
       ↓
Procesamiento y almacenamiento
```

La imagen enviada al servidor corresponde al recorte realizado por el usuario.

Se utiliza **Intervention Image** para el procesamiento de imágenes desde Laravel.

### Feed

El feed muestra las publicaciones de los usuarios con los que existe una relación de seguimiento aceptada.

Las publicaciones se cargan mediante paginación y se muestran progresivamente utilizando un patrón de **infinite scroll**.

El funcionamiento es:

```text
Página 1
   ↓
Mostrar publicaciones
   ↓
Usuario llega al final
   ↓
Cargar página 2
   ↓
Agregar publicaciones
   ↓
Usuario continúa desplazándose
   ↓
Cargar página 3
```

En lugar de cargar todas las publicaciones de una sola vez, cada página obtiene una cantidad limitada de registros y posteriormente los nuevos resultados se agregan a los que ya están cargados.

Este patrón permite mantener una cantidad controlada de información en cada consulta y proporcionar una experiencia de desplazamiento continuo.

### Likes en publicaciones

* Dar like a una publicación.
* Quitar like.
* Mostrar contador de likes.
* Comprobar si el usuario autenticado ya dio like.
* Notificar al propietario de la publicación cuando otro usuario da like.

La existencia de un like se comprueba mediante la relación correspondiente utilizando Eloquent.

### Comentarios

* Crear comentarios.
* Mostrar comentarios paginados.
* Cargar más comentarios.
* Mostrar contador de likes.
* Dar like a comentarios.
* Quitar like a comentarios.
* Eliminar comentarios propios.
* Notificar al propietario de la publicación cuando recibe un comentario.

Los comentarios utilizan paginación para evitar cargar todos los registros de una publicación al mismo tiempo.

Los permisos para eliminar comentarios se controlan mediante autorización.

Un comentario puede ser eliminado por:

```text
Propietario del comentario
        OR
Propietario de la publicación
```

Esto permite que tanto el usuario que realizó el comentario como el propietario de la publicación puedan administrar los comentarios correspondientes.

### Respuestas a comentarios

* Responder comentarios.
* Mostrar respuestas.
* Dar like a respuestas.
* Quitar like a respuestas.
* Eliminar respuestas propias.
* El propietario de la publicación puede eliminar respuestas pertenecientes a sus publicaciones.
* Notificar respuestas a los usuarios correspondientes.

Las respuestas utilizan una relación autorreferenciada mediante `parent_id`.

La estructura utilizada es:

```text
Comentario
   ├── Respuesta
   ├── Respuesta
   └── Respuesta
```

Cada respuesta mantiene una relación con el comentario padre mediante `parent_id`.

### Seguidores y seguidos

El sistema de seguimiento utiliza una tabla pivot para representar la relación entre usuarios.

La tabla contiene:

```text
user_id
follower_id
status
```

El estado de la relación permite diferenciar entre:

```text
pending
accepted
```

El flujo de seguimiento es:

```text
Usuario A
   ↓
Solicita seguir
   ↓
Usuario B
   ↓
Solicitud pendiente
   ↓
Usuario B acepta
   ↓
Relación aceptada
   ↓
Usuario A puede acceder a las publicaciones
```

Funcionalidades implementadas:

* Seguir usuarios.
* Enviar solicitudes de seguimiento.
* Aceptar solicitudes.
* Rechazar solicitudes.
* Mostrar el estado de seguimiento.
* Contar seguidores.
* Contar usuarios seguidos.
* Mostrar seguidores.
* Mostrar usuarios seguidos.
* Controlar el acceso a publicaciones mediante el estado de la relación.

Las relaciones entre usuarios utilizan `belongsToMany()` de Eloquent y datos adicionales de la tabla pivot mediante `withPivot()`.

### Privacidad

El acceso a las publicaciones está relacionado con el estado de seguimiento entre usuarios.

Cuando una cuenta requiere aprobación, la solicitud permanece pendiente:

```text
pending
```

hasta que el propietario de la cuenta la acepta.

Después de ser aceptada:

```text
accepted
```

el usuario puede acceder a las publicaciones correspondientes.

De esta manera, el sistema controla el acceso al contenido mediante las relaciones entre usuarios.

### Búsqueda de usuarios

* Buscar usuarios.
* Buscar por nombre.
* Buscar por username.
* Búsqueda dinámica.
* Debounce para evitar consultas innecesarias.
* Paginación de resultados.
* Carga progresiva de usuarios.

La búsqueda se implementó mediante Livewire para actualizar los resultados sin recargar completamente la página.

Cuando cambia el término de búsqueda, la paginación y los resultados cargados se reinician para comenzar nuevamente desde la primera página.

### Notificaciones

SocialGram cuenta con un sistema de notificaciones para diferentes interacciones dentro de la aplicación.

Se generan notificaciones relacionadas con:

* Likes en publicaciones.
* Likes en comentarios.
* Nuevos seguidores.
* Solicitudes de seguimiento aceptadas.
* Nuevos comentarios.
* Respuestas a comentarios.

Las notificaciones permiten identificar la acción realizada y al usuario relacionado con dicha acción.

### Navegación desde notificaciones

Las notificaciones relacionadas con comentarios permiten navegar directamente hasta el comentario correspondiente.

Para lograrlo se utiliza `sessionStorage` junto con Livewire y JavaScript.

El flujo es:

```text
Notificación
      ↓
Usuario selecciona la notificación
      ↓
Se guarda temporalmente el ID del comentario
      ↓
Navegación hacia la publicación
      ↓
Livewire carga los comentarios
      ↓
Se busca el comentario
      ↓
Se cargan más páginas si es necesario
      ↓
Se encuentra el comentario
      ↓
Livewire envía un evento
      ↓
JavaScript recibe el ID
      ↓
Scroll hasta el comentario
      ↓
Se resalta temporalmente
```

Esto permite encontrar comentarios que todavía no se encuentran dentro de las páginas cargadas inicialmente.

### Comunicación entre Livewire y JavaScript

El proyecto utiliza diferentes mecanismos de comunicación entre Livewire y JavaScript.

JavaScript puede modificar propiedades de Livewire mediante:

```js
$wire.set('commentId', commentId);
```

Livewire puede enviar eventos mediante:

```php
$this->dispatch('comment-found', commentId: $this->commentId);
```

JavaScript puede escuchar estos eventos mediante:

```js
$wire.on('comment-found', ({ commentId }) => {
    // ...
});
```

Este patrón permite coordinar actualizaciones realizadas por Livewire con acciones que necesitan ejecutarse directamente en el navegador.

### Manipulación del DOM

JavaScript se utiliza para determinadas interacciones visuales que necesitan trabajar directamente con el DOM.

Entre ellas:

* Buscar elementos mediante `getElementById()`.
* Scroll automático.
* Scroll suave.
* Resaltar temporalmente comentarios.
* Focus automático en el campo de comentarios.
* `requestAnimationFrame()`.
* `setTimeout()`.
* Manipulación de clases mediante `classList`.

Los comentarios utilizan identificadores únicos:

```html
<div id="comment-62">
```

Esto permite localizar posteriormente un comentario específico desde JavaScript.

### Componentes Livewire

Livewire se utiliza para construir gran parte de las interfaces interactivas de la aplicación.

Entre las funcionalidades implementadas se encuentran:

* Feed de publicaciones.
* Infinite scroll.
* Comentarios.
* Respuestas.
* Likes.
* Búsqueda de usuarios.
* Seguimiento de usuarios.
* Notificaciones.
* Perfil.
* Modales.
* Formularios interactivos.
* Actualización de información sin recargar la página.
* Comunicación entre componentes.

Se utilizan propiedades públicas, métodos, eventos, listeners, hooks de actualización y paginación para controlar el estado de los componentes.

## Relaciones Eloquent

La aplicación utiliza diferentes relaciones de Eloquent para representar la estructura de la red social.

Entre ellas:

* `belongsTo`
* `hasMany`
* `belongsToMany`

La estructura principal incluye:

```text
User
 ├── Posts
 ├── Comments
 ├── Likes
 ├── Followers
 └── Following

Post
 ├── User
 ├── Comments
 └── Likes

Comment
 ├── User
 ├── Post
 ├── Likes
 ├── Parent
 └── Replies
```

También se utilizan relaciones autorreferenciadas para representar las respuestas de los comentarios.

## Consultas y paginación

Durante el desarrollo se utilizaron diferentes herramientas de Eloquent:

* `with()` para eager loading.
* `withCount()` para obtener conteos.
* `exists()` para comprobar la existencia de registros.
* `where()`.
* `whereIn()`.
* Consultas mediante relaciones.
* Condiciones sobre tablas pivot.
* Paginación.
* Carga progresiva de información.

La paginación se utiliza principalmente en:

* Feed.
* Comentarios.
* Búsqueda de usuarios.

Los resultados de cada página se agregan a los resultados previamente cargados para implementar el patrón de infinite scroll.

## Autorización

La aplicación utiliza autorización para controlar determinadas acciones sobre los recursos.

Por ejemplo, antes de eliminar un comentario se verifica mediante una Policy si el usuario tiene permiso para realizar la acción.

Los permisos permiten diferenciar entre:

```text
Propietario del recurso
        OR
Propietario de la publicación
```

dependiendo de la acción que se esté realizando.

Esto evita que un usuario pueda eliminar recursos que no le corresponden.

## Conceptos aplicados

* Arquitectura MVC de Laravel.
* Componentes Livewire.
* Blade.
* Alpine.js.
* JavaScript.
* Relaciones Eloquent.
* `belongsTo`.
* `hasMany`.
* `belongsToMany`.
* Tablas pivot.
* Relaciones autorreferenciadas.
* Eager loading.
* `withCount()`.
* `exists()`.
* `where()`.
* `whereIn()`.
* Paginación.
* Infinite scroll.
* Eventos de Livewire.
* Comunicación JavaScript ↔ Livewire.
* Hooks de actualización.
* Manipulación del DOM.
* `sessionStorage`.
* Autenticación.
* Autorización.
* Policies.
* Protección de rutas.
* Validación de formularios.
* Manejo de archivos.
* Procesamiento de imágenes.
* Migraciones.
* Seeders.
* Notificaciones.
* Variables de entorno.
* Tailwind CSS.
* Vite.

## Diseño e interfaz

La interfaz fue desarrollada utilizando Tailwind CSS, Blade, Livewire y Alpine.js.

Se buscó mantener un diseño limpio y sencillo utilizando componentes reutilizables para las diferentes partes de la aplicación.

Entre las interfaces desarrolladas se encuentran:

* Feed.
* Perfiles.
* Publicaciones.
* Comentarios.
* Respuestas.
* Búsqueda de usuarios.
* Notificaciones.
* Modales.
* Formularios de creación de publicaciones.

## Instalación

Clonar el repositorio:

```bash
git clone https://github.com/devjmmg/socialgram.git
cd socialgram
```

Instalar las dependencias de PHP:

```bash
composer install
```

Instalar las dependencias de JavaScript:

```bash
npm install
```

Crear el archivo de configuración:

```bash
cp .env.example .env
```

Generar la clave de la aplicación:

```bash
php artisan key:generate
```

Configurar en `.env` las credenciales de la base de datos y los parámetros necesarios para ejecutar la aplicación.

Ejecutar las migraciones:

```bash
php artisan migrate
```

Crear el enlace simbólico para el almacenamiento:

```bash
php artisan storage:link
```

Iniciar Vite:

```bash
npm run dev
```

En otra terminal iniciar el servidor de Laravel:

```bash
php artisan serve
```

La aplicación estará disponible en:

```text
http://127.0.0.1:8000
```

## Demo

[Ver aplicación](https://laravel-socialgram.onrender.com)

## Autor

Juan Manuel Martínez García

GitHub: [devjmmg](https://github.com/devjmmg)
