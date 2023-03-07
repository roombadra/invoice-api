<?php

namespace App\Http\Middleware\Api\v1;

use Closure;
use App\Models\Profile;
use App\Models\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->profile_id !== Profile::USER['id']) {
            return ApiResponse::errors(['message' => 'You are not authorized to access this resource.'], 403);
        }
        return $next($request);
    }
}
