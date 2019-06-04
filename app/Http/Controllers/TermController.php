<?php

namespace App\Http\Controllers;

use App\Http\Requests\TermRequest;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')
            ->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::all();

        return $terms;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TermRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TermRequest $request)
    {
        $term = new Term($request->only('name', 'slug', 'taxonomy'));
        $term->save();

        return $this->created($term);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Term $term
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Term $term
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Term         $term
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Term $term
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        //
    }
}
