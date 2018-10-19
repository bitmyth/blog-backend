<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Post::class, 12)->create()->each(function ($p) {
            $p->comments()->save(factory(\App\Models\Comment::class)->make());
            $p->comments()->save(factory(\App\Models\Comment::class)->make());
            $p->increment('comment_count');
            $p->tags()->save(factory(\App\Models\Tag::class)->make());
            $p->tags()->save(factory(\App\Models\Tag::class)->make());
            $p->tags()->save(factory(\App\Models\Category::class)->make());
        });
    }
}
