<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.index',['tickets'=>Ticket::all(),'users'=>User::all()]);
    }
}
