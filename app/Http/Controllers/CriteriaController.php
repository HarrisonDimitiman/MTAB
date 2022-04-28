<?php

namespace App\Http\Controllers;

use App\Models\{Criteria,Event};
use Illuminate\Http\Request;
use DB;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id, $programs_id)
    {
        $allCrits = Criteria::where('event_id', $event_id)->get();
        $event = Event::where('id', $event_id)->first();
        return view('criteria.viewCrits',compact('allCrits', 'event','programs_id'));
    }

    public function addCriteria(Request $request)
    {
        $countsum = Criteria::sum('crt_score');
        //    dd($count);
            $totalAll = $countsum +  $request->crt_score;
            
            if($totalAll <= 100){
                    $judges = new Criteria();
                    $judges->crt_name = $request->crt_name;
                    $judges->crt_score = $request->crt_score;
                    $judges->event_id = $request->event_id;
                    $judges->save();
                    return redirect()->back()->with('success','Successfully Created Sub=Criteria');
            }
            else
            {
                    return redirect()->back()->with('error','Sub-Criteria Percentage Exceeded 100%!!!');
            }
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
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Criteria $criteria, $crt_id)
    {
        $getCrt = Criteria::where('id', $crt_id)->first();
        // return $getCrt;
        return view('criteria._modalCrt',compact('getCrt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criteria $criteria, $crt_id)
    {
        $validatedData = $request->validate([
            'crt_name' => '',
        ]);
        $getCrt = Criteria::where('id', $crt_id)->first();
        $upCrt = array();
        $upCrt['crt_name'] = $request->crt_name;
        $upCrt['crt_score'] = $request->crt_score;
        DB::table('criterias')->where('id', $crt_id)->update($upCrt);

        return redirect()->back()->with('success','Successfully Updated Criteria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criteria, $crt_id, $programs_id, $event_id)
    {
        DB::table('criterias')->where('id', $crt_id)->update(['deleted_at' => Carbon::now()]);
        // $events->delete();
        // dd($programs_id);
        return Redirect::to('/viewCrits/'.$event_id.'/'.$programs_id)
            ->with('message','Criteria deleted successfully. <a href="'.URL::to('/crtRestore/'.$crt_id.'/'.$programs_id).'">Whoops, Undo</a>');
    }

    public function restore(int $id, int $programs_id)
    {
        // dd($id);
        $crt = Criteria::withTrashed()->find($id);
        if($crt && $crt->trashed()){
            $crt->restore();    
        }
        return redirect()->back()->with('message','Criteria Restored succesfully');     
    }
}
