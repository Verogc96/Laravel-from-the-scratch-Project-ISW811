[< Volver al índice](../index.md)

# Blade Layout Two Ways
 A continuación los pasos para crear un layout para las vistas.


## Creando un archivo layout
 Existen dos maneras de poner en practica un Layout, la primera es creando un archivo llamado `layout.blade.php`  en la carpeta de vistas el cual se vería así:

 ```php
<!DOCTYPE html>
    <title>LFTS</title>
    <link rel="stylesheet" href="app.css">

    <body>
        <header>
            @yield('banner')
        </header>
        @yield('content')
    </body>
</html>
 ```

 Y los siguientes archivos de vistas de la siguiente manera:

 - posts.blade.php

```php
    @extends ('layout')

    @section('banner')
        <h1>
            My Blog
        </h1>
    @endsection


    @section ('content')
        @foreach ($posts as $post)

    <article>

        <h1>
            <a href="/posts/{{ $post->slug }}">
            {{$post->title}}
            </a>
        </h1>

        <div>
            {{$post->excerpt}}
        </div>

        </article>

        @endforeach

    @endsection
```

- post.blade.php

```php
@extends('layout')

@section('content')
<article>
    <h1><?=$post->title; ?></h1>
    <div>
        <?=$post->body; ?>
    </div>
</article>
@endsection
```

## Creando Blade Components

Nos permitirá envolver las partes de los html.
En `resources/views` se crea una carpeta llamada *_components_* y movemos la carpeta de layout.blade.php ahí y la vamos a modificar de la siguiente manera:

```php
<!DOCTYPE html>
    <title>LFTS</title>
    <link rel="stylesheet" href="app.css">

    <body>
        {{ $slot }}
    </body>
</html>

```

Y en la vista `posts.blade.php` queda así, se agrega como una etiqueta html con x- + el nombre de la vista:

```php
    <x-layout>
        @foreach ($posts as $post)

            <article>

                <h1>
                    <a href="/posts/{{ $post->slug }}">
                    {{$post->title}}
                    </a>
                </h1>

                <div>
                    {{$post->excerpt}}
                </div>

            </article>

        @endforeach

    </x-layout>
```


