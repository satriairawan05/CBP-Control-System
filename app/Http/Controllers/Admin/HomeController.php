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
        $this->middleware(['auth']);
    }

    /**
     * Display a listing for User of the resource.
     */
    public function home()
    {
        \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' mengakses halaman home');
        return view('admin.home',[
            'name' => $this->name
        ]);
    }
}
