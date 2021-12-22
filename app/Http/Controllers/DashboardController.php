<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
           'title' => 'Dashboard Template · Bootstrap v5.1' 
        ];

        return view('dashboard.index', $data);
    }
}
