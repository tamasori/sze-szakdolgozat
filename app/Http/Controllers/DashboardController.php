<?php


namespace App\Http\Controllers;


use App\Services\Graphs\QuarterlyCarsCountGraph;

class DashboardController
{
    public function index()
    {
        return view("dashboard.dashboard");
    }
}
