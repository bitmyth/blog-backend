<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Term;

class CategoryController extends TermController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Term::where('taxonomy', 'category')->get();
    }
}
