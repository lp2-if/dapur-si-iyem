<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Glosary extends Model
{
    protected $table = 'glosaries';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name', 'description'];

    use SoftDeletes;
}
