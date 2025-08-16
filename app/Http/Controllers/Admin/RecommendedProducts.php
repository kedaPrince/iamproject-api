<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecommendedProducts extends Controller
{
     public function index(){

        return view('admin.recommended.index');
    }

     public function create(){

        return view('admin.recommended.create');
    }
}