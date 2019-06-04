<?php

namespace App\Http\Controllers;

use App\Models\Term;

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
