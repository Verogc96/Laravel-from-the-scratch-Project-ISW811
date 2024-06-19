[< Volver al índice](../index.md)


# Eager Load Relationships on an Existing Model

En nuestra aplicacion se tiene un problema a la hora de consultar los posts por categoria, ya que hace demasiadas consultas a la base de datos. 

Para optimizar esta consulta se debe de realizar unas pequeñas modificaciones para aplicar los Eager Load:

### En el documento Post.php

Agregar la siguiente linea de codigo

```php
 protected $with = ['category', 'author'];
```

### En el documento web.php

Se modifica el codigo de las siguientes rutas de esta manera:

```php
Route::get('/', function () {
   return view ('posts', [
    'posts'=> Post::latest()->get()
   ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {

    return view ('posts', [
        'posts'=> $category->posts
    ]);
});

Route::get('/authors/{author}', function (User $author) {
    return view ('posts', [
        'posts'=> $author->posts
    ]);
});
```

Esto nos permite pasar de 24 a solamente 4 segun Clockwork.
