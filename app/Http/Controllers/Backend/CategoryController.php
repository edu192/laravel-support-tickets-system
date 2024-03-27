<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.category.index');
    }
}
