<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
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
        $tags = Tag::factory(10)->create();
        $articles = Article::factory(50)->create();
        $comments = Comment::factory(100)->create();

        foreach ($articles as $article) {
            $tagsId = $tags->random(5)->pluck('id');
            $article->tags()->attach($tagsId);
        }
    }
}
