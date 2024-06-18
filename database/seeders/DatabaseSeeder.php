<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
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
            'excerpt'=>'Lorem ipsum dolar sit amet.',
            'body'=>'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent semper, eros id placerat auctor, metus lorem sodales justo, non facilisis sapien enim sit amet tortor. Phasellus sagittis erat blandit, ultrices eros vel, ultrices mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ipsum mauris, venenatis non condimentum a, ultricies quis diam. Etiam commodo sodales tellus id faucibus. Maecenas dignissim, justo vel cursus viverra, felis augue lacinia eros, id ullamcorper erat ex a mi. Mauris non nulla dignissim quam ultrices tincidunt vitae ac elit.</p>',
        ]);

        Post::create([
            'user_id'=> $user->id,
            'category_id'=> $family->id,
            'title'=> 'My Work Post',
            'slug'=>'my-work-post',
            'excerpt'=>'Lorem ipsum dolar sit amet.',
            'body'=>'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent semper, eros id placerat auctor, metus lorem sodales justo, non facilisis sapien enim sit amet tortor. Phasellus sagittis erat blandit, ultrices eros vel, ultrices mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ipsum mauris, venenatis non condimentum a, ultricies quis diam. Etiam commodo sodales tellus id faucibus. Maecenas dignissim, justo vel cursus viverra, felis augue lacinia eros, id ullamcorper erat ex a mi. Mauris non nulla dignissim quam ultrices tincidunt vitae ac elit.</p>',
        ]);
    }
}
