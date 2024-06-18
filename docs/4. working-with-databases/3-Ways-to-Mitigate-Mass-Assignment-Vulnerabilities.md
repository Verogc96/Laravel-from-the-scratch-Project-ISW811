[< Volver al índice](../index.md)

# 3 Ways to Mitigate Mass Assignment Vulnerabilities
Existe otra manera de crear datos dentro de una tabla y es por medio de Asignacion Masiva, sin embargo en primera estancia se bloquea y no lo permite, debemos de realizar un cambio en el codigo de **Post.php** quedando de la siguiente manera:

```php
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'body'];
}
```

Y creamos otro post utilizando Tinker de la siguiente manera:

```bash
- php artisan tinker
- Post::create(['title'=> 'My Third Post', 'excerpt'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse neque ante, pharetra ac felis in, varius dignissim risus', 'body'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse neque ante, pharetra ac felis in, varius dignissim risus. Duis aliquam, turpis eget convallis pellentesque, ex erat tempor dui, sed lacinia sapien nunc porta ipsum. Etiam id justo eu libero dictum accumsan a ut erat. Aliquam et auctor elit, venenatis scelerisque tortor. Pellentesque purus velit, egestas eget leo sed, feugiat suscipit purus. Donec posuere, nunc a tristique iaculis, dui odio pellentesque leo, in vulputate velit quam convallis erat. Morbi pellentesque molestie massa non placerat. Fusce euismod, lacus id efficitur maximus, dolor nisl dictum nisl, a elementum ex augue sit amet augue. Phasellus sagittis hendrerit aliquet.']);
```
Acá existen dos conceptos importantes:
- **Fillable**: es cuando permitimos que ciertos datos de las entidades de la tabla se pueden llenar de forma masiva.
- **Guarded**: cuando queremos protreger los datos que se ingresan a hacia cada entidad.
