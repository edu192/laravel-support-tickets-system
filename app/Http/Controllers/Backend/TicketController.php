<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        return view('backend.ticket.index');
    }
}
