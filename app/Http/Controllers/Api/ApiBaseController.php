<?php
/**
 * Created by PhpStorm.
 * User: walbertus
 * Date: 4/21/18
 * Time: 12:41 PM
 */

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class ApiBaseController extends Controller
{
    public function sendCreated($data, $msg = "created")
    {
        return $this->send($data, $msg, 201);
    }

    public function sendNoContent($msg = "updated", $code = 204)
    {
        return $this->send(null, $msg, $code);
    }

    public function send($data, $msg = "success", $code = 200)
    {
        return Response::json(
            [
                'message'     => $msg,
                'status_code' => $code,
                'data'        => $data
            ], $code);
    }
}