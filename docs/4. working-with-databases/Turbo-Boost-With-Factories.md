[< Volver al índice](../index.md)

# Turbo Boost with Factories

Las fabricas son un patron de diseño utilizado para crear objetos de una manera rapida y sencilla. En nuestro caso para generar datos fake para pruebas en nuestra base de datos.

- Primeramente vamos a ejecutar el siguiente comando:

```bash
php artisan make:factory PostFactory
php artisan make:factory CategoryFactory
```

Lo anterior para que nos genere el archivo **_PostFactory.php_** en la ruta `database/factories`.

Luego creamos un model para comments con el comando:


```bash
php artisan make:model Comments -mf
```
El **_-mf_** nos permite generar de una vez el archivo model y el factory.

Le realizamos un reset a la base de datos con `php artisan migrate:fresh`

## Modificacion de archivos Factory y Seeder

#### CategoryFactory.php
Se definen los tipos de datos de las entidades a generar.+
```php
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
        ];
    }

```

#### PostFactory.php
Se definen los tipos de datos de las entidades a generar.

```php
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'slug' => $this->faker->slug,
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
    }

```

#### DatabaseSeeder.php
Se modifica el codigo para que cuando se ejecute el comando de seed cree 5 posts pero se relacionen que el usuario ya creado igualmente con favtory
```php
    public function run()
    {
       $user = User::factory()->create([
        'name' => 'John Doe'
       ]);

        Post::factory(5)->create([
            'user_id'=>$user->id
        ]);
    }
```

Finalmente hacemos un `php artisan db:seed`
