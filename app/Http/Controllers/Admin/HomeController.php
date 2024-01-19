<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = "Home")
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing for User of the resource.
     */
    public function home()
    {
        return view('admin.home',[
            'name' => $this->name
        ]);
    }
}
