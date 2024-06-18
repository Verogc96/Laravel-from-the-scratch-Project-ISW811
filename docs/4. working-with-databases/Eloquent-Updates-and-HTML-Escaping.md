[< Volver al índice](../index.md)

# Eloquent Updates and HTML Escaping

Cuando creamos un dato en la base de datos puede que a la hora de interpretarlo nuestra aplicacion lo transforme en un cadena de texto y no con etiqueta html <p>, por lo que se pueden perder los formatos establecidos.

Por lo que se puede proceder a corregir esto de la siguiente manera:

- php artisan tinker
- $post = new App\Models\Post;
- $post->body = '<p>' . $post->body . '</p>';
- $post->save();

En el archivo post.blade.php modificamos la linea de `{{posts->title}}` y la cambiamos por ` <h1>{!!$post->title!!}</h1>`. Para poder enviar texto txt y que el programa lo interprete como corresponde y no como texto plano.
