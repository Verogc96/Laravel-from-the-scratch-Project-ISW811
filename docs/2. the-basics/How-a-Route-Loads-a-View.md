[< Volver al índice](../index.md)

# How a route Loads a View

En Laravel las rutas se configuran en el archivo `routes/web.php`.

Por ejemplo con el siguiente fragmento se renderiza la vista _Welcome_.

```php
Route::get('/', function () {
    return view('welcome');
});
```
**_Importante: en nuestro documento `routes/web.php` se declaran todas las rutas para que la página responda todas las solicitudes de redireccionamiento._**

Y esta se encuentra completamente ligada a los documentos `.php.` que encuentren en la ruta `resources/views` y que deben de contener el mismo nombre que se indican en las rutas. Por ejemplo en lo indicado anteriormente, en la carpeta "views" existe un documento llamado `welcome.blade.php` que posee el codigo html de la página de bienvenida de Laravel.



Laravel puede retorna cualquier tipo de contenido, por ejemplo, código HTML.

```php
Route::get('/html', function () {
    return '<h1>Esto es HTML</h1>';
});
```

Incluso puede retornar JSON.

```php
Route::get('/json', function () {
    return ['foo' => 'bar'];
});