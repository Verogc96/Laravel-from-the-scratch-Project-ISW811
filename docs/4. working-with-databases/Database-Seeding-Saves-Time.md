[< Volver al índice](../index.md)

# Database Seeding Saves Time

Vamos a hacer que los posts tambien tengan el dato del autor como un elemento clickable al igual que con la categoria. Para ello vamos a realizar las siguientes modificaciones:

#### post.blade.php

```php
<x-layout>
<article>
    <h1>{!!$post->title!!}</h1>
    <p>
        By <a href="#">Jeffrey Way</a><a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
    </p>
    <div>
        {!!$post->body!!}
    </div>
</article>

<a href = "/">Go Back</a>
</x-layout>
```

#### Archivo de migracion de la tabla posts
Agregamos un foreignId para el usuario.
```php
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('slug')-> unique();
            $table->text('excerpt');
            $table->text('body');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }
```

Luego ejecutamos el comando `php artisan migrate:fresh` sin embargo cada vez que ejecutamos este comando se nos borra toda la informacion contenida, para ello nos ubicamos en la ruta `database/seeders/DatabaseSeeder.php` y descomentamos el codigo que se encuentra dentro de la funcion run() y lo modificamos de la siguiente manera:

```php
    public function run()
    {
        User::truncate();
        Category::truncate();
        Post::truncate();

        $user= User::factory()->create();

        $personal = Category::create([
            'name'=> 'Personal',
            'slug'=>'personal',
        ]);

        $family = Category::create([
            'name'=> 'Family',
            'slug'=>'family',
        ]);

        $work = Category::create([
            'name'=> 'Work',
            'slug'=>'work',
        ]);

        Post::create([
            'user_id'=> $user->id,
            'category_id'=> $family->id,
            'title'=> 'My Family Post',
            'slug'=>'my-first-post',
            'excerpt'=>'<p>Lorem ipsum dolar sit amet.</p>',
            'body'=>'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent semper, eros id placerat auctor, metus lorem sodales justo, non facilisis sapien enim sit amet tortor. Phasellus sagittis erat blandit, ultrices eros vel, ultrices mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ipsum mauris, venenatis non condimentum a, ultricies quis diam. Etiam commodo sodales tellus id faucibus. Maecenas dignissim, justo vel cursus viverra, felis augue lacinia eros, id ullamcorper erat ex a mi. Mauris non nulla dignissim quam ultrices tincidunt vitae ac elit.</p>',
        ]);

        Post::create([
            'user_id'=> $user->id,
            'category_id'=> $family->id,
            'title'=> 'My Work Post',
            'slug'=>'my-work-post',
            'excerpt'=>'<p>Lorem ipsum dolar sit amet.</p>',
            'body'=>'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent semper, eros id placerat auctor, metus lorem sodales justo, non facilisis sapien enim sit amet tortor. Phasellus sagittis erat blandit, ultrices eros vel, ultrices mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ipsum mauris, venenatis non condimentum a, ultricies quis diam. Etiam commodo sodales tellus id faucibus. Maecenas dignissim, justo vel cursus viverra, felis augue lacinia eros, id ullamcorper erat ex a mi. Mauris non nulla dignissim quam ultrices tincidunt vitae ac elit.</p>',
        ]);
    }
```

Posteriormente ejecutamos el comando `php artisan db:seed` y el nos va a crear 1 usuario por defecto y las tres categorias indicadas. Esto para no estar incluyendo la informacion manualmente cada vez que se realiza un migrate:fresh

Para hacer un migrate:fresh sin que se borren los datos se ejecuta el comando `php artisan migrate:fresh --seed`.

Luego agregamos la funcion para establecer la relacion entre users y posts. Esto se realiza moidificando los siguientes archivos:

#### Post.php

Agregar la funcion user

```php
  public function user()
    {
        return $this->belongsTo(User::class);

    }
```

#### User.php

```php
public function posts()
    {
        return $this->hasMany(Post::class);
    }
```

