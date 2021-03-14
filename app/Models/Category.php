<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function getCategories ()
    {
        return DB::table('categories')
            ->get();
    }

    public function getCategory(int $id)
    {
        return DB::table('categories')
            ->where('id', '=', $id)
            ->first();
    }

    public function deleteRecord(int $id)
    {
        return DB::table('categories')
            ->where('id', $id)
            ->delete();
    }
}
