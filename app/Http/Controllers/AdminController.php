<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public const ADMIN_URI_PREFIX = 'admin';

    public function index(Request $request)
    {
        return view('admin.index');
    }
}
