<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemMessages extends Controller
{
    public function SystemIndex()
    {
        return view('users.system.index');
    }
}
