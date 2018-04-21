<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    protected $table = 'ingredients';
    protected $primaryKey = 'id';
    public $timestamps = true;

    use SoftDeletes;

    protected $fillable = ['name', 'image'];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'foods_ingredients', 'ingredient_id', 'food_id');
    }
}
