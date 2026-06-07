<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryKAL extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'color'];

    public function tasks()
    {
        return $this->hasMany(TaskKAL::class, 'category_id');
    }
}
