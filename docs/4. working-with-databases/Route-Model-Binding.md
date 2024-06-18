[< Volver al índice](../index.md)

# Route Model Binding

Es cuando se une el dato de la route key con el Eloquent Model, en este caso de Post.php. El nombre del wilcard debe de coincidir con el nombre de la variable en la función.
El archivo llamado **_web.php:** se modifica de la siguiente manera:

```php
Route::get('/posts/{post:slug}', function (Post $post) {

    return view ('post', [
        'post'=> $post
    ]);
});
```

Luego modificamos el archivo de migrations y agregamos la entidad "slug":

```php
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')-> unique();
            $table->text('excerpt');
            $table->text('body');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }
```

Y en posts.blade.php cambiamos el $id por $slug:

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
