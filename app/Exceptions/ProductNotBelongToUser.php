<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongToUser extends Exception
{
    public function render($request)
    {
        if($request->expectsJson()) {
            return response()->json(["error"=>"Product not belong to user"]);
        }
    }
}
