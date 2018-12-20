<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{

    public function test()
    {
    	session('key',1);
    	var_dump(session('key'));
    }
}
