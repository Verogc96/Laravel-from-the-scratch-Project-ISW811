[< Volver al índice](../index.md)

# Make a Post Model and Migration

Se elimina la carpeta `Post.php` ubicada en la carpeta models. Posteriormente se ejecuta el siguiente comando en la maquina webserver:

- php artisan make:migration create_posts_table

Luego nos ubicamos en la carpeta `database/migrations` y seleccionamos la que se acaba de crear. Ya estando ahi en la función create agregamos los atributos deseados, el código queda de la siguiente manera:

```php
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt');
            $table->text('body');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }
```
 Y luego se ejecuta el comando `php artisan migrate` para que los cambios se guarden en la base de datos.
 Posteriormente se ejecuta el comando `php artisan make:model Post`. El nombre del modelo es la version en singular del nombre de la tabla en la base de datos.

Ingresamos nuevamente a tinker con el comando `php artisan tinker` para crear un post.

- $post = new App\Models\Post
- $post->title = "My First Post";
- $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse neque ante, pharetra ac felis in, varius dignissim risus. ";
- $post->body="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse neque ante, pharetra ac felis in, varius dignissim
risus. Duis aliquam, turpis eget convallis pellentesque, ex erat tempor dui, sed lacinia sapien nunc porta ipsum. Etiam id justo eu libero dictum accumsan a ut erat. Aliquam et auctor elit, venenatis scelerisque tortor. Pellentesque purus velit, egestas eget leo sed, feugiat suscipit purus. Donec posuere, nunc a tristique iaculis, dui odio pellentesque leo, in vulputate velit quam convallis erat. Morbi pellentesque molestie massa non placerat. Fusce euismod, lacus id efficitur maximus, dolor nisl dictum nisl, a elementum ex augue sit
amet augue. Phasellus sagittis hendrerit aliquet."
- $post->save();

Y luego se sale de tinker y se ejecuta el comando `php artisan serve`.

En el documento llamado `web.php`, se cambia el codigo quedando de la siguiente manera:

```php
Route::get('/posts/{post}', function ($id) {

    return view ('post', [
        'post'=> Post::findOrFail($id)
    ]);
});
```

Y el documento `posts.blade.php`

```php
    <x-layout>
        @foreach ($posts as $post)

            <article>

                <h1>
                    <a href="/posts/{{ $post->id }}">
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
