
## MercaTodo 

Esta aplicación hace que el concepto de tienda virtual sea mucho mas fácil de entender y poner en
marcha cualquier negocio o emprendimiento. asi que comencemos con la instlación del proyecto.

- **requisitos previos**
    * -Servidor "en entorno local preferiblente laragon 4.0"
    * -PHP Version 7.4 
    * -Laravel 7  
    * -mysql 5.7 

- **Clonar el repositorio [https://github.com/sebastianManco/retoPlaceToPay.git]**.
**NOTA** la carpeta raíz del proyecto debe quedar alojada, en la carpeta principal del servidor. 

- **Abra el terminal y procede a ejecutar los siguientes comandos**

        * -cd retoPlaceToPay
        * -composer install
        * -npm install
        * -cp .env.example .env
    
**Configuración de la base de datos en mysql**
    teniendo instalado el mysql en el ordenador, lo ejecuta desde su espacio de trabajo favorito en cosola, phpMyAdmin, Workbetch, etc. 
    crea una base de datos llamada retoplacetopay (si prefiere llamarla de otra manera, recuerde que debe cambiar el nombre en el archivo de configuración .env)
    Luego de terminar la configuración, pase a ejecutar los siguientes comandos desde la consola.                                                              
    
    php artisan migrate
    php artisan db:seed
   
   El comando anterior crea dos usuarios, cada uno con un rol asignado administrador y usuario.
   
    admin 
        email: doe.example@gmail.com
        contraseña: 123456789
    user
        email: user.example@example.com
        contraseña: 789456123.
        
   por último ejecutar el comando, para la creacion del link simbolico
    
    php artisan storage:link 
    
  ##DOCUMENTACIÓN API
  **Productos**
    Esta petición ha de ser tipo GET y le traerá como resultado todos los produtos, paginados de la base de datos en un array data con formato JSON:
    http://127.0.0.1:8000/api/products
    
 **Mostrar un producto en especifícifico**
    Esta petición ha de ser tipo GET y le traerá como resultado el producto deseado de la base de datos en un array data con formato JSON. Recibe un parametro id de tipo entero.
    si el valor entero no existe en la base de datos la API arrojará código 404 que no ha encontrado dicho valor.
    http://127.0.0.1:8000/api/products/$id
    
 **Crear Nuevo producto**
     Esta petición ha de ser tipo POST y le permitirá crear un nuevo producto y almacenarlo en la base de datos. 
     http://127.0.0.1:8000/api/products
     los datos aceptados son los siguientes
            "name": "String",
            "description": "texto",
            "category": "entero",
            "price": "entero",
            "stock": "entero"
     
 **Actualizar producto**
    Esta petición ha de ser tipo PUT y le permitirá actualizar el producto seleccionado y almacenarlo en la base de datos. Recibe un parametro id de tipo entero junto con los         valores dispuestos a actualizar.
    si el valor entero no existe en la base de datos la API arrojará código 404 que no ha encontrado dicho valor.
    http://127.0.0.1:8000/api/products/$id
    
   los datos aceptados son los siguientes
      "name": "String",
      "description": "texto",
      "category": "entero",
      "price": "entero",
      "stock": "entero"
      
   **categorias**
    Esta petición ha de ser tipo GET y le traerá como resultado todos las categoriass, paginadas de la base de datos en un array data con formato JSON:
    http://127.0.0.1:8000/api/categories
    
 **Mostrar una categoría en especifícifico**
    Esta petición ha de ser tipo GET y le traerá como resultado la categoría deseadoa de la base de datos en un array data con formato JSON. Recibe un parametro id de tipo entero.
    si el valor entero no existe en la base de datos la API arrojará código 404 que no ha encontrado dicho valor.
    http://127.0.0.1:8000/api/categores/$id
    
 **Crear Nueva categoría**
     Esta petición ha de ser tipo POST y le permitirá crear un nuevo producto y almacenarlo en la base de datos. 
     http://127.0.0.1:8000/api/categories
     los datos aceptados son los siguientes
            "name": "String",

