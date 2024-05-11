<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function apiResponse($status, $message, $data, $error, $meta = [], $info = [])
    {
        return is_array($error) ?
            response()->json([
                'status'   => $status,
                'message'  => __($message),
                'data'     => $data,
                'meta'     => $meta,
                'error'    => [],
                'info'     => $info,
            ], $status) :

            response()->json([
                'status'   => $status,
                'message'  => __($message),
                'data'     => $data,
                'meta'     => $meta,
                'error'    => [
                    [
                        "field" => "genric",
                        "errors" => [$error]
                    ],
                ],
                'info' => $info,
            ], $status);
    }
}
