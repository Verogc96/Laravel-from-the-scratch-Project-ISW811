[< Volver al índice](../index.md)

# Route Wildcard Constraints
Muchas veces se desea que cuando se redirecciona una página, nuestro url solo acepte ciertos parámetros, para eso tenemos las Wildcards. En este caso vamos a modificar el archivo `web.php`, donde tenemos las rutas, para utilizar expresiones regulares de la siguiente manera:

```php
Route::get('/posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if(! file_exists($path)){
        //return redirect('/');
        ddd($path);
    }
    $post = file_get_contents($path);
    return view('post', [
        'post' => $post
    ]);
})->where ('post', '[A-z_\-]+');

```

Tambien se puede utilizar `->whereAlpha`, `whereAlphaNumeric`, `WhereNumber` para que nos genere expresiones regulares ya predeterminadas.