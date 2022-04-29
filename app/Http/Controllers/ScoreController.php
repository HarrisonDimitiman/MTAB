<?php

namespace App\Http\Controllers;

use App\Models\{Score, Contestant, Criteria, Event};
use Illuminate\Http\Request;
use DB;
use Auth;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contestant = Contestant::orderBy('number', 'ASC')->get();
        $criteria = array();
        $event = Event::get();

        return view('score.index', compact('contestant', 'criteria', 'event'));
    }

    public function getCritsEvent($event_id, $contestant_id)
    {
        $criteria = Criteria::where('event_id', $event_id)->get();
        $contestant = Contestant::where('id', $contestant_id)->first();
        $ifAlreadyScore = Score::where('event_id', $event_id)
                            ->where('contestant_id', $contestant_id)
                            ->where('user_id', Auth::user()->id)
                            ->count();
        $criteria2nd = Score::join('criterias', 'criterias.id', 'scores.crit_id')
                            ->where('scores.event_id', $event_id)
                            ->where('scores.contestant_id', $contestant_id)
                            ->where('scores.user_id', Auth::user()->id)
                            ->select('criterias.crt_name', 'scores.score', 'scores.crit_id')
                            ->get();
        $value;
        if($ifAlreadyScore <= 0)
        {
            $value = 0;
        }
        elseif($ifAlreadyScore >= 1)
        {
            $value = 1;
        }
        // return $value;               
        return view('score._showCritScoring', compact('criteria', 'event_id', 'contestant', 'value', 'criteria2nd'));
    }

    public function saveScore(Request $request, $jUser_id, $event_id, $contestant_id)
    {
        $crt_id = $request->input('crit_id');
        array_unshift($crt_id,"");
        unset($crt_id[0]);
        $crtLength = count($crt_id);

        $score = $request->input('score');
        array_unshift($score,"");
        unset($score[0]);
        $scoreLength = count($score);
        $scoreSum = array_sum($score);

        $ifAlreadyScore = Score::where('event_id', $event_id)
                            ->where('contestant_id', $contestant_id)
                            ->where('user_id', Auth::user()->id)
                            ->count();

        $getEventPercentage = Event::where('id', $event_id)->first();
        $totalEvent = $scoreSum * $getEventPercentage->percentage;

        for($i = 1; $i <= $crtLength; $i++)
        {
            $data = array();
            $data['user_id'] = $jUser_id;
            $data['crit_id'] = $crt_id[$i];
            $data['event_id'] = $event_id;
            $data['contestant_id'] = $contestant_id;
            $data['total'] = $totalEvent;
            $data['overAllTotal'] = 0;
            $data['score'] = $score[$i];

            DB::table('scores')
                ->insert($data);
        }


        $ifAlreadyScoreByEvent = Score::where('contestant_id', $contestant_id)
                            ->where('user_id', Auth::user()->id)
                            ->get()
                            ->keyBy('event_id');

        $ifAlreadyScoreByEventP2 = Score::where('contestant_id', $contestant_id)
                            ->where('user_id', Auth::user()->id)
                            ->get()
                            ->keyBy('event_id');                    

        $countEvent = Event::count();

        
        $sum=array();
        foreach($ifAlreadyScoreByEventP2 as $ifAlreadyScoreByEventP2)
        {
            $sum[] = $ifAlreadyScoreByEventP2->total;
        }
        $sumOverAll = array_sum($sum);
        

        // UPDATE FOR OVERALL TOTAL
        if($ifAlreadyScoreByEvent->count() == $countEvent)
        {
            
            $getLatestScore = Score::where('contestant_id', $contestant_id)
                    ->where('user_id', Auth::user()->id)
                    ->latest('id')
                    ->first();
            $data2 = array();
            $data2['overAllTotal'] = $sumOverAll;

            // DB::table('scores')
            //     ->where('id', $getLatestScore->id)
            //     ->update($data2);
            Score::query()->where('contestant_id', $contestant_id)->update($data2);
           
        }

        return redirect()->back()->with('success','Successfull');
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
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
