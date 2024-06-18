[< Volver al índice](../index.md)

# Blade: The Absolute Basics

Blade son plantillas que se utilizan en proyectos Laravel para las vistas de la aplicación. Siempre debe de incluirse ya que en caso de que sea por ejemplo un archivo solamente *.php*, esto nos puede generar errores de compilación en las vistas.

En el directorio `framework/views` se pueden observar las versiones compiladas de Vainilla JavaScript para las vistas que tenemos configuradas en `.blade.php`. Por ejemplo si en nuestro archivo `posts.blade.php` tenemos una línea de codigo `{[$post->title]}` el sistema la compilará como `<?php echo e($post->title); ?>`. Si quisieramos hacer lo mismo pero con bloques html se colocan signos de exclamación así `{!!$post->body!!}`

Se realizaron unos cambios de sintaxis que son más amigables y lucen mejor en el código, por ejemplo en **_posts.blade.php_**:

```php
<!DOCTYPE html>
    <title>LFTS</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
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
</body>
</html>
```

Podemos usar el @ antes de una directiva y funciona igual que incluirle la sintaxis php.
