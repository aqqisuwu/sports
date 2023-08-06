<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image','description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_sport', 'sport_id', 'category_id');
    }

}
