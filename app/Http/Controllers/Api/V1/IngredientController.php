<?php
/**
 * Created by PhpStorm.
 * User: walbertus
 * Date: 4/21/18
 * Time: 12:54 PM
 */

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiBaseController;
use App\Model\Ingredient;

class IngredientController extends ApiBaseController
{
    public function index()
    {
        $ingredients = Ingredient::all('id', 'name');
        return $this->send($ingredients);
    }

    public function show(Ingredient $ingredient)
    {
        $requiredData = [
            'id' => $ingredient->id,
            'name' => $ingredient->name,
            'description' => $ingredient->note
        ];

        return $this->send($requiredData);
    }
}