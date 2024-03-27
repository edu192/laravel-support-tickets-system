<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('backend.department.index');
    }
}
