[< Volver al índice](../index.md)

# Environment Files and Database Connections

Todos los credenciales y datos para conexiones con bases de datos se debe incluir en el archivo .env ubicado en la carpeta raiz del proyecto. Este archivo nunca debe subirse al git.
En el archivo `database.php` es donde se establece el parámetro de conexión, en este caso utilizando `env` y `mysql`.
En este proyecto el archivo `.env` debe de contener la siguiente informacion, la cual ya estaba establecida:

```env
DB_CONNECTION=mysql
DB_HOST=192.168.56.11
DB_PORT=3306
DB_DATABASE=lfts
DB_USERNAME=laravel
DB_PASSWORD=secret
```

En la máquina donde tenemos la base de datos ingresamos con `mysql -ularavel -p` y dinamicamente nos solicita la contraseña. Y ejecutamos el comando `create database lfts`

Nos salimos de la BD y ejecutamos el comando `php artisan migrate`

Posteriormente decargamos **_TablePlus_** en nuestra maquina anfitriona para el manejo de la base de datos.

Ingresamos a la aplicación y seleccionamos _Crear_ y seleccionamos _mysql_ ingresamos los siguientes datos:

- Nombre de la conexión: Local
- Puerto: 3306
- Nombre de Usuario: laravel
- Contraseña: secret
- Nombre de la base de datos: lfts

Y finalmente seleccionamos _Conectar_. Si todo es correcto nos aparece una pantalla en la aplicación con las tablas de la base de datos.
