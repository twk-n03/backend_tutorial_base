<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'article_id' => 1,
            'user_id' => 1,
            'content' => 'This is a comment.',
        ]);

        Comment::create([
            'article_id' => 1,
            'user_id' => 2,
            'content' => 'This is another comment.',
        ]);

        Comment::create([
            'article_id' => 2,
            'user_id' => 1,
            'content' => 'This is a comment on another article.',
        ]);

    }
}
