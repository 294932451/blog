<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {
    	return view('admin.index');
    }

    public function welcome()
    {
    	return view('admin.welcome');
    }

    public function logout()
    {
    	session()->flush();
    	return redirect('admin/login');
    }
}
