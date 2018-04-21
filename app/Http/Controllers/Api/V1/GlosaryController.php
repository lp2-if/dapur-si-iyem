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
        $glosaries = Glosary::all();
        return $this->send($glosaries);
    }
}