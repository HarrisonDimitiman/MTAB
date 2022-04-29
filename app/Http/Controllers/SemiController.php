<?php

namespace App\Http\Controllers;

use App\Models\Semi;
use Illuminate\Http\Request;

class SemiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('semi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semi  $semi
     * @return \Illuminate\Http\Response
     */
    public function show(Semi $semi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semi  $semi
     * @return \Illuminate\Http\Response
     */
    public function edit(Semi $semi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semi  $semi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semi $semi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semi  $semi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semi $semi)
    {
        //
    }
}
