<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frase;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $frases= Frase::orderBy('created_at', 'desc')
                    ->paginate(3);

        return view('home',compact('frases'));
    }
}
