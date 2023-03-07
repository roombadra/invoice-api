<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiResponse extends Model
{
    public static function success($data, int $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], $code);
    }

    public static function errors($data, int $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'data' => $data
        ], $code);
    }
}
