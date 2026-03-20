<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    public function articles()
    {
        return $this->hasOne(Article::class, 'article_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public $timestamps = true;

    protected $fillable = [
        'article_id',
        'user_id',
        'content'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'article_id' => 'integer'
    ];

}