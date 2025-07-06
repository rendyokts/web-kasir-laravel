<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Dokumentasi API WebKasir",
 *     description="Dokumentasi API untuk aplikasi WebKasir",
 *     @OA\Contact(
 *         email="support@webkasir.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */

class OpenApiController extends Controller {}
