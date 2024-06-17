[< Volver al índice](../index.md)

# Use Caching for Expensive Operations

Utilizar la caché de la máquina nos permite dejar de consultar cada vez que se hace un refresh a la página, y en cambio almacenar la información en esta memoria, por lo que debe de modificar el documento `web.php` de la carpeta `routes` de la siguiente manera:

```php
Route::get('/posts/{post}', function ($slug) {
    if(! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")){
        //return redirect('/');
        ddd($path);
    }

    $post = cache()->remember("posts.{$slug}", 1200, fn()=>file_get_contents($path));
  
    return view('post', [
        'post' => $post
    ]);
})->where ('post', '[A-z_\-]+');

```