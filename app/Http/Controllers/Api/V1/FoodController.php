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

class FoodController extends ApiBaseController
{
    public function index()
    {
        $foods = Food::all();
        return $this->send($foods);
    }
}