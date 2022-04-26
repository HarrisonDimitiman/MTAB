<?php

namespace App\Http\Controllers;

use App\Models\Judges;
use Illuminate\Http\Request;
use DB;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class JudgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allJudges = Judges::get();
        return view('judges.index',compact('allJudges'));
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
        $judges = new Judges();
        $judges->judges_name = $request->judges_name;
        $judges->save();
        return redirect()->back()->with('success','Successfully Created Judges');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function show(Judges $judges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function edit(Judges $judges, $jud_id)
    {
        $getJudge = Judges::where('id', $jud_id)->first();
        return view('judges._modal',compact('getJudge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Judges $judges, $jud_id)
    {
      

        $upJud = array();
        $upJud['judges_name'] = $request->judges_name;
        DB::table('judges')->where('id', $jud_id)->update($upJud);

        return redirect()->back()->with('success','Successfully Updated Judge');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function destroy(Judges $judges, $jud_id)
    {
        DB::table('judges')->where('id', $jud_id)->update(['deleted_at' => Carbon::now()]);
        return redirect()->route('judges.index')
            ->with('message','Judge deleted successfully. <a href="'.URL::to('/judRestore/'.$jud_id).'">Whoops, Undo</a>');
    }

    public function restore(int $id)
    {
        // dd($id);
        $jud = Judges::withTrashed()->find($id);
        if($jud && $jud->trashed()){
            $jud->restore();    
        }
        return redirect()->back()->with('message','Judge Restored succesfully');     
    }
}
