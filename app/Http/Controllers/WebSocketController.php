<?php

namespace App\Http\Controllers;

use App\Events\laravelWebSocket;
use Illuminate\Http\Request;

class WebSocketController extends Controller
{
    public function index()
    {
        // var_dump("in");exit;
        event(new laravelWebSocket);
    }
}
