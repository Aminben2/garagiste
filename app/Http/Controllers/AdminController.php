<?php

namespace App\Http\Controllers;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        return view('admin.stats');
    }
}
