[< Volver al índice](../index.md)

# How to Extract a Dropdown Blade Component

Este episodio es solamente una mejor manera de manejar el componente del dropdown, haciendolo por aparte. Para ello se deben seguir los siguientes pasos:

## Agregar el nombre a las rutas

Esto lo haremos en la ruta de home y categories

```php
Route::get('/', function () {
   return view ('posts', [
    'posts'=> Post::latest()->get(),
    'categories'=> Category::all()
   ]);
})->name('home');

Route::get('/categories/{category:slug}', function (Category $category) {

    return view ('posts', [
        'posts'=> $category->posts,
        'currentCategory'=>$category,
        'categories'=> Category::all()
    ]);
})->name('category');
```

Y luego ejecutar los siguientes comandos para limpiar la cache de las rutas y guardar los cambios:

```bash
cd /vagrant/sites/lfts.isw811.xyz/
php artisan view:clear
php artisan route:cache
```

## Luego creamos los archivos **icon.blade.php**, **dopdown-item.blade.php** y **dropdown.blade.php**  en la carpeta resources/views/components

Luego agregamos codigo de la siguiente manera:

- **icon.blade.php**
```php
@props(['name'])

@if ($name === 'down-arrow')
    <svg {{ $attributes(['class' => 'transform -rotate-90']) }} width="22" height="22" viewBox="0 0 22 22">
        <g fill="none" fill-rule="evenodd">
            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
            </path>
            <path fill="#222"
                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
        </g>
    </svg>
@endif

```


- **dopdown-item.blade.php**

```php
@props(['active' => false])

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white';
    if ($active) $classes .= ' bg-blue-500 text-white';
@endphp

<a {{ $attributes(['class' => $classes]) }}
>{{ $slot }}</a>

```

- **dropdown.blade.php**

```php
@props (['trigger'])


{{--Trigger--}}

<div x-data="{show:false}" @click.away="show=false">
    <div @click="show = ! show">
        {{ $trigger}}
    </div>

{{--Links--}}

    <div x-show = "show" class = "py-2 absolute bg-gray-100 w-full mt-2 rounded-xl z-50" style="display:none">
        {{$slot}}
    </div>
</div>

```

Esto lo que nos permite es separar la responsabilidad de los componentes


## Modificar el codigo de **_posts-header.blade.php**

Se modifica el bloque de codigo donde tenemos el dropdown de las categorias, quedando de la siguiente manera:

```php
<div class="relative lg:inline-flex bg-gray-100 rounded-xl">
        <x-dropdown>
            <x-slot name="trigger">
                <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
                    {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

                    <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>
                </button>
            </x-slot>

            <x-dropdown-item href="/" :active="request()->routeIs('home')">All</x-dropdown-item>

            @foreach ($categories as $category)
                <x-dropdown-item
                    href="/categories/{{ $category->slug }}"
                    :active='request()->is("categories/{$category->slug}")'
                >{{ ucwords($category->name) }}</x-dropdown-item>
            @endforeach
        </x-dropdown>
        </div>
```

En este codigo solo "llamamos" los componentes que se crearon anteriormente como ***x-dropdown***, ***x-icon*** y ***x-dropdown-item*** y agregarle el codigo necesario para que funcione. Nuestra aplicacion funciona tal cual a como se encontraba en el capitulo anterior pero con un codigo mas limpio.
