<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class followController extends Controller
{
    public function following()
    {
        return view('dashboard.following');
    }
}
