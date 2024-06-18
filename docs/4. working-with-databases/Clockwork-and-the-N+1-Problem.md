[< Volver al índice](../index.md)

# Clockwork, and the N+1 Problem

## Instalando Clockwork

Este es una herramienta de php que contiene dev tools. Se ejecutan los siguientes comandos para su instalacion:

```bash
cd /vagrant/sites/lfts.isw811.xyz
composer require itsgoingd/clockwork
```

Luego en la documentacion sobre Clockwork en github en el link [Github-Clockwork](https://github.com/itsgoingd/clockwork?tab=readme-ov-file) descargan la extension para el browser que se este utilizando.

Se deben de modificar el siguiente codigo para evitar que se realicen mas queries de la cuenta en nuestra base de datos:

### web.php

```php
Route::get('/', function () {
   return view ('posts', [
    'posts'=> Post::with('category')->get()
   ]);
});
```


