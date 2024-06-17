[< Volver al índice](../index.md)

# Store Blog Posts ad HTML Files

A estas alturas se ha logrado hacer el link para redireccionar cuando se selecciona algún elemento de nuestra página web, pero en el anterior no era dinámica la forma de seleccionar el post y que nos mostrara el post correcto, ya que siempre se cargaba el de "My First Post", por lo que se hará cada post como una variable que contendrá los datos del post seleccionado, se trabajará sobre los archivos `web.php`, `post.blade.php`, `posts.blade.php`.

Primero vamos a crear una carpeta llamada `posts` en el directorio `ISW811\VMs\webserver\sites\lfts.isw811.xyz\resources` utilizando mkdir y dentro de la carpeta posts agregamos tres archivos html, uno para cada post

```bash
- cd ISW811\VMs\webserver\sites\lfts.isw811.xyz\resources
mkdir posts
cd posts
touch my-first-post.html my-second-post.html my-third-post.html
```

## Archivo post.blade.php
Se elimina el texto del post para hacerlo dinámico, por lo que se agregará una variable que hará referencia al post seleccionado:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LFTS</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
   <article>
        <?=$post; ?>
    </article>
</body>
</html>
```

## Archivo web.php
En la línea donde se está configurando la ruta, se agregará un parámentro a la función en el cual se le pasará cuál post estamos seleccionado, se crea una variable path para indicar la ubicación de los archivos html creados anteriormente. Luego se agrega un manejo de errores para que en caso que no se encuentre el post, la página no se caiga, en mi caso dejé para que me redirija a la página principal en estos casos, pero puede ser con `dd` donde se indica el error. Finalmente retorna la vista de post que se había codificado anteriormente:

```php
Route::get('/posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if(! file_exists($path)){
        return redirect('/');
        //dd('file does not exist')
    }
    $post = file_get_contents($path);
    return view('post', [
        'post' => $post
    ]);
});
```
## Archivo posts.blade.php
Se modifican las rutas donde se redirige cuando se selecciona cada posts, quedando de la siguiente manera;

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LFTS</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
   <article>
        <h1><a href="/posts/my-first-post">My First Post</a></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et lectus eu orci tincidunt vehicula. 
            Aliquam egestas, massa eu eleifend maximus, magna ligula vestibulum mauris, vel blandit ligula massa ac mi. 
            Duis at sagittis erat, quis euismod est. Donec sed ex at leo aliquet efficitur id sed lacus. 
            Nam tincidunt lectus mi, a suscipit leo mattis sed. Duis pharetra tincidunt leo tincidunt pharetra. 
            Vestibulum a tristique leo. Donec vulputate felis lacinia ullamcorper efficitur. Pellentesque habitant morbi tristique 
            senectus et netus et malesuada fames ac turpis egestas. Cras at ante eros. In ipsum odio, luctus at posuere quis, feugiat eu enim.</p>
    </article>
    <article>
        <h1><a href="/posts/my-second-post">My Second Post</a></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et lectus eu orci tincidunt vehicula. 
            Aliquam egestas, massa eu eleifend maximus, magna ligula vestibulum mauris, vel blandit ligula massa ac mi. 
            Duis at sagittis erat, quis euismod est. Donec sed ex at leo aliquet efficitur id sed lacus. 
            Nam tincidunt lectus mi, a suscipit leo mattis sed. Duis pharetra tincidunt leo tincidunt pharetra. 
            Vestibulum a tristique leo. Donec vulputate felis lacinia ullamcorper efficitur. Pellentesque habitant morbi tristique 
            senectus et netus et malesuada fames ac turpis egestas. Cras at ante eros. In ipsum odio, luctus at posuere quis, feugiat eu enim.</p>
   </article>
   <article>
        <h1><a href="/posts/my-third-post">My Third Post</a></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et lectus eu orci tincidunt vehicula. 
            Aliquam egestas, massa eu eleifend maximus, magna ligula vestibulum mauris, vel blandit ligula massa ac mi. 
            Duis at sagittis erat, quis euismod est. Donec sed ex at leo aliquet efficitur id sed lacus. 
            Nam tincidunt lectus mi, a suscipit leo mattis sed. Duis pharetra tincidunt leo tincidunt pharetra. 
            Vestibulum a tristique leo. Donec vulputate felis lacinia ullamcorper efficitur. Pellentesque habitant morbi tristique 
            senectus et netus et malesuada fames ac turpis egestas. Cras at ante eros. In ipsum odio, luctus at posuere quis, feugiat eu enim.</p>
   </article>
</body>
</html>
```

Finalmente en la carpeta posts en cada archivo html se agrega el contenido corresponde a cada post.