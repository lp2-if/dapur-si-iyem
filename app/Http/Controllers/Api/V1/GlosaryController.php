<?php
/**
 * Created by PhpStorm.
 * User: walbertus
 * Date: 4/21/18
 * Time: 12:49 PM
 */

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiBaseController;
use App\Model\Glosary;

class GlosaryController extends ApiBaseController
{
    public function index()
    {
        $glosaries = Glosary::all(['id', 'name']);

        $res = [];

        foreach ($glosaries->sortBy('name') as $glosary)
        {
            if(!isset($res[$glosary->name[0]])) $res[$glosary->name[0]] = [];

            array_push($res[$glosary->name[0]],$glosary);
        }

        return $this->send($res);
    }

    public function show(Glosary $glosary)
    {
        $requiredData = [
            'id' => $glosary->id,
            'name' => $glosary->name,
            'description' => $glosary->description
        ];

        return $this->send($requiredData);
    }
}