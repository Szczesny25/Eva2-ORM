<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "hola",
    description: "nose le verda"
)]
#[OA\Server(
   url: "/api",
   description: "API en el mismo servidor"
)]

abstract class Controller
{
    //
}
