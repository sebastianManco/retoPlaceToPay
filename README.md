
## MercaTodo 

Esta aplicación hace que el concepto de tienda virtual sea mucho mas fácil de entender y poner en
marcha cualquier negocio o emprendimiento. asi que comencemos con la instlación del proyecto.

- **requisitos previos**
    + -Servidor "en entorno local preferiblente laragon 4.0"
    * -PHP Version 7.4 
    * -Laravel 7  
    * -mysql 5.7 

- **Clonar el repositorio [https://github.com/sebastianManco/retoPlaceToPay.git]**.
**NOTA** la carpeta raíz del proyecto debe quedar alojada, en la carpeta principal del servidor. 

- **Abra el terminal y procede a ejecutar los siguientes comandos**
- *-cd retoPlaceToPay
- *-composer install
- *-npm install
- *-cp .env.example .env

     
**Configuración de la base de datos en mysql**
    teniendo instalado el mysql en el ordenador lo ejecutamos en consola y posteriormente
    
*-CREATE DATABASE retoplacetopay;

    sale de la terminal de mysql he ingresa de nuevo a la ruta del proyecto, aún permaneciendo en consola. ejecuta:
    
    php artisan migrate
    
    php artisan db:seed
    
    **el comando anterior crea dos usuarios, cada uno con un rol asignado administrador y usuario**
    
    *-admin 
        email: doe.example@gmail.com
        contraseña: 123456789
    *- user
        email: user.example@example.com
        contraseña: 789456123
        
 **comando propio de la aplicación**
 
    *-email:reportDaily 
