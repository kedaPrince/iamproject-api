<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleProductsController extends Controller
{
     public function index(){

        return view('admin.single-products.index');
    }

     public function create(){

        return view('admin.single-products.create');
    }
}