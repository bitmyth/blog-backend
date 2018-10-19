<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Term;
use Illuminate\Http\Request;

class TagController extends TermController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Term::where('taxonomy', 'tag')
            ->get();
        return $this->toArray($categories);
    }
}
