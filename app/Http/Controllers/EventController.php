<?php

namespace App\Http\Controllers;

use App\Models\{Event,Program,Score,User,SemiScore,TerminalScore, Contestant};
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;
use URL;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $programs_id)
    {
        $event = Event::join('programs','programs.id','events.programs_id')
            ->select('events.*')
            ->where('events.programs_id',$programs_id)->get();
        $prgm = Program::where('id', $programs_id)->first();
        return view('event.index',compact('event', 'programs_id', 'prgm'));
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
            'event_name' => 'required|unique:events',
        ]);
        $event=new Event();
        $event->event_name = $request->event_name;
        $event->programs_id = $request->programs_id;
        $event->percentage = $request->event_percentage;
        $event->save();

        return redirect()->back()->with('success','Successfully Created Event');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, $events_id)
    {
        $getEvents = Event::where('id', $events_id)->first();
        return view('event._modal',compact('getEvents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, $events_id)
    {
        $validatedData = $request->validate([
            'event_name' => '',
        ]);
        $getEvents = Event::where('id', $events_id)->first();
        $upEvents = array();
        $upEvents['event_name'] = $request->event_name;
        $upEvents['percentage'] = $request->event_percentage;
        DB::table('events')->where('id', $events_id)->update($upEvents);

        return redirect()->back()->with('success','Successfully Updated Event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */

    public function destroy(Event $events, $events_id, $programs_id)
    {
        DB::table('events')->where('id', $events_id)->update(['deleted_at' => Carbon::now()]);
        // $events->delete();
        // dd($programs_id);
        return Redirect::to('/event/'.$programs_id)
            ->with('message','Event deleted successfully. <a href="'.URL::to('/eventRestore/'.$events_id.'/'.$programs_id).'">Whoops, Undo</a>');
    }

    public function restore(int $id, int $programs_id)
    {
        // dd($id);
        $event = Event::withTrashed()->find($id);
        if($event && $event->trashed()){
            $event->restore();    
        }
        return Redirect::to('/event/'.$programs_id)->with('message','Event restored succesfully');        
    }
    public function ResultbyEvent($event_id)
    {
        $pdf=PDF::loadView('pdf.ResultbyEvent');

        $getEvent = Event::get();
        // $getContestant = Contestant::get();
        // $getContestantCount = $getContestant->count();

        $getContestantToArray = Contestant::get();
        $getContestantToArray = $getContestantToArray->toArray();

        $getContestantToArray2nd = $getContestantToArray;
        array_unshift($getContestantToArray2nd,"");
        unset($getContestantToArray2nd[0]);
        $getContestantToArray2ndLength = count($getContestantToArray2nd);

        $getUserJudge = User::whereHas(
            'roles', function($q){
                $q->where('name', 'judge');
            }
        )->get()->toArray();
        // $getUserJudgeCount = $getUserJudge->count();
        
        $getUserJudge2nd = $getUserJudge;
        array_unshift($getUserJudge2nd,"");
        unset($getUserJudge2nd[0]);
        $getUserJudge2ndLength = count($getUserJudge2nd);

        $tempChecker = 0;
        for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
        {
            for($j = 1; $j <= $getUserJudge2ndLength; $j++)
            {
                $checkContestanIfJudge = DB::table('scores')
                    ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                    ->where('user_id', $getUserJudge2nd[$j]['id'])
                    ->where('overAllTotal', '!=', 0)
                    ->get()->keyBy('user_id');

                if($checkContestanIfJudge->count() <= 0)
                {
                    $tempChecker = $tempChecker + 1;
                }
                else
                {
                    $tempChecker;
                }

            }
        }


        $dataArrayNi = array();
        if($tempChecker != 0)
        {
            return "WALA PA KA SCORE TANAN JUDGE SA CONSTESTANT";
        }
        elseif($tempChecker == 0)
        {
            
            for($i = 1; $i <= $getContestantToArray2ndLength; $i++)
            {
                $overAllTotalContestantPerJudge = 0;
                for($j = 1; $j <= $getUserJudge2ndLength; $j++)
                {
                    $checkContestanIfJudge = DB::table('scores')
                        ->where('contestant_id', $getContestantToArray2nd[$i]['id'])
                        ->where('user_id', $getUserJudge2nd[$j]['id'])
                        ->where('event_id', $event_id)
                        ->get()->keyBy('contestant_id');

                    $overAllTotalContestantPerJudge = $overAllTotalContestantPerJudge + $checkContestanIfJudge[$i]->total;


                    if ($j == $getUserJudge2ndLength)
                    {
                       
                        // $dataArrayNi["Contestant ".$getContestantToArray2nd[$i]['id']] = $getContestantToArray2nd[$i]['id'];
                        // $dataArrayNi[] = $overAllTotalContestantPerJudge;
                        $dataArrayNi[] = array(
                            "Contestant" => $getContestantToArray2nd[$i]['name'],
                            "Score" => $overAllTotalContestantPerJudge
                          );
                    }
                    
                }

                
                
            }
            // $object = (object) $dataArrayNi;
            
            
                
        }
        echo "<pre>";
                print_r($dataArrayNi);
            echo "</pre>";

        // $countItems = count($dataArrayNi);
        // // return $countItems;
        // $pdf=PDF::loadView('pdf.ResultbyEvent',compact('dataArrayNi'));
        // return $pdf->stream('ResultbyEvent.pdf'); 
            


        // return $getUserJudge2nd;
        // return $pdf->stream('ResultbyEvent.pdf'); 
    }
    public function ResultbyEventTop6()
    {
        $top6 = Score::join('contestants','contestants.id','scores.contestant_id')
        ->orderBy('overAllTotalJudge', 'DESC')
        ->where('overAllTotalJudge', '!=', null)
        ->get()
        ->keyBy('contestant_id')->take(6);
        $getUserJudge = User::whereHas(
            'roles', function($q){
                $q->where('name', 'judge');
            }
        )->get();
        // dd($getUserJudge);
        $pdf=PDF::loadView('pdf.ResultbyEventTop6',compact('top6','getUserJudge'));
        return $pdf->stream('ResultbyEventTop6.pdf'); 
    }
    public function ResultbyEventTop3()
    {
        $top3 = SemiScore::join('contestants','contestants.id','semi_scores.contestant_id')
        ->orderBy('total', 'DESC')
        ->get()
        ->keyBy('contestant_id')->take(3);
        $getUserJudge = User::whereHas(
            'roles', function($q){
                $q->where('name', 'judge');
            }
        )->get();
        $pdf=PDF::loadView('pdf.ResultbyEventTop3',compact('top3','getUserJudge'));
        return $pdf->stream('ResultbyEventTop3.pdf'); 
    }
    public function ResultbyEventFinal()
    {   $final = TerminalScore::join('contestants','contestants.id','terminal_scores.contestant_id')
        ->orderBy('overAllTotalJudge', 'DESC')
        ->where('overAllTotalJudge', '!=', null)
        ->get()
        ->keyBy('contestant_id')->take(3);
        $getUserJudge = User::whereHas(
            'roles', function($q){
                $q->where('name', 'judge');
            }
        )->get();
        $pdf=PDF::loadView('pdf.ResultbyEventFinal',compact('final','getUserJudge'));
        return $pdf->stream('ResultbyEventFinal.pdf'); 
    }
}
