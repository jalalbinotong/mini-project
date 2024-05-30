<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class notifController extends Controller
{
    public function notif()
    {
        return view('dashboard.users.pages.notifikasi');
    }
}
