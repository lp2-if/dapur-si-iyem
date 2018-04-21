<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    protected $table = 'foods';
    protected $primaryKey = 'id';
    public $timestamps = true;

    use SoftDeletes;

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'foods_ingredients', 'food_id', 'ingredient_id');
    }
}
