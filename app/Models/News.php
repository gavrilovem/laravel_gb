<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'text', 'category_id', 'is_private'
    ];

    public function getNewsCollection () {
        return DB::table('news')
            ->get();
    }

    public function getNews(int $id) {
        return DB::table('news')
            ->where('id', '=', $id)
            ->get()[0];
    }

    public function getNewsWithCategoryId(int $id) {
        return DB::table('news')
            ->where('category_id', '=', $id)
            ->get();
    }
}
