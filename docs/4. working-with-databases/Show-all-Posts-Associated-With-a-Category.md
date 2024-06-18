[< Volver al índice](../index.md)

# Show All Posts Associated With a Category

Para poder mostrar los posts de una categoria neesitamos crear una nueva ruta, esto se hace en el archivo `web.php` de la carpeta routes.

```php
Route::get('/categories/{category:slug}', function (Category $category) {

    return view ('posts', [
        'posts'=> $category->posts
    ]);
});
```

Luego modificamos el archivo `Category.php` de la carpeta models agregando la siguiente funcion para hacer la relacion de los posts con las categorias:

```php
 public function posts()
    {
        return $this->hasMany(Post::class);
    }
``` 

Y finalmente corregimos la linea donde se agrega la ruta del elemento linkeable para acceder a los posts de las categorias quedando de la siguiente manera:

```html
<a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
```
