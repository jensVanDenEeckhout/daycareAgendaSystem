<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;
use App\Task;
use App\Cell;
use App\Client;
use App\Floor;
use App\Employee;
use App\Category;

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

            $clients =  Client::all();
            //dd($clients);
            $employees = Employee::all();
            $floors = Floor::all();
            return view('pages.overzichtBewoners')
            ->with('floors',$floors)
            ->with('employees',$employees)
            ->with('clients',$clients);
    }
}
