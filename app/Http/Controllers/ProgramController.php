<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prgm = Program::get(); 
        return view('program.index', compact('prgm'));
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
        $validated = $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        Program::create($validated);
        return redirect()->back()->with('success','Successfully Created Program');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        return view('program._modal',compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $validatedData = $request->validate([
            'name' => '',
            'date' => '',
        ]);

        $program = $program->update($validatedData);
        return redirect()->back()->with('success','Successfully Updated Program');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('program.index')
            ->with('message','Program deleted successfully. <a href="'.route('program.restore',$program->id).'">Whoops, Undo</a>');
    }
    public function restore(int $id)
    {
        $program = Program::withTrashed()->find($id);
        if($program && $program->trashed()){
            $program->restore();    
        }
        return redirect()->route('program.index')->with('message','Program restored succesfully');        
    }
}
