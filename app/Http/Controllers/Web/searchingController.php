<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class searchingController extends Controller
{
    public function searching()
    {
        return view('dashboard.users.pages.searching');
    }
}
