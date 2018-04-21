<?php
/**
 * Created by PhpStorm.
 * User: walbertus
 * Date: 4/21/18
 * Time: 12:40 PM
 */

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiBaseController;
use App\Model\Food;
use Illuminate\Http\Request;

class FoodController extends ApiBaseController
{
    public function index(Request $request)
    {
        $ingredientsId = $request->all();
        $foods = Food::with('ingredients')->limit(20)->get(['id', 'name', 'tutorial', 'image']);
        foreach ($foods as $food){
            $exist = 0;
            foreach ($food->ingredients as $ingredient){
                if (in_array($ingredient->id, $ingredientsId)){
                    $exist++;
                }
            }
            $food['missing'] = $food->ingredients->count() - $exist;
        }
        $sortedFoods = $foods->sortBy('missing');
        return $this->send($sortedFoods->values()->all());
    }

    public function show(Food $food)
    {
        $requiredData = [
            'id' => $food->id,
            'name' => $food->name,
            'tutorial' => $food->tutorial,
            'recipe' => $food->recipe,
            'image' => $food->image

        ];

        return $this->send($requiredData);
    }
}