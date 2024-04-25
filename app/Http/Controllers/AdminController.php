<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public const ADMIN_SUBDOMAIN = 'admin';

    public function index(Request $request)
    {
        return view('admin.index');
    }
}
