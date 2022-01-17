<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//view za registrovane korisnike
//        return view('admin.home');
//    }

    public function __invoke()
    {
        return view('admin.home');
    }
}
