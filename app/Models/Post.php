<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable=['title','post','photo','category_id'];
    protected $connection = 'mysql';

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
