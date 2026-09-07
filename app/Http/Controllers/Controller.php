<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "hola",
    description: "nose le verda"
)]
#[OA\Server(
   url: "http://127.0.0.1:8000",
   description: "Servidor de desarrollo local"
)]

abstract class Controller
{
    //
}
