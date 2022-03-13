# Freedom Ride es una página web dedicada a las rutas a caballo en España. Si quieres disfrutar de las mejores rutas a caballo, éste es tu sitio.

Este proyecto ha sido creado con [Symfony](https://symfony.com/download).


## Instrucciones para la instalación

Primero: Comprobar que se dispone de Symfony y Composer [composer](https://getcomposer.org/download/)

Segundo: Clonar el proyecto usando el siguiente comando en consola: `git clone https://github.com/DaveSG1/project-server.git` 

Tercero: Situado en la carpeta generada para el proyecto, ejecutar, por éste orden, los comandos: `composer update` y despues `composer install`

Cuarto: Dentro de la carpeta raíz crear un archivo .env.local y añadir la siguiente línea de código: 
```
DATABASE_URL="mysql://usuario:usuario@127.0.0.1:3306/freedomride?serverVersion=5.7&charset=utf8mb4"

```

Quinto: Ejecutar comando `symfony console doctrine:database:create`

Sexto : Ejecutar comando `symfony console doctrine:migrations:migrate`

Séptimo: En la carpeta files se encuentran los archivos sql de las entidades de la base de datos para poder importarlos la base de datos generada en el quinto apartado.

Octavo: Ejecutar comando `symfony console lexik:jwt:generate-keypair` para generar las keys JWT para el login y el registro.

Noveno: Ejecutar comando `symfony serve -d`
